<?php
Namespace Drupal\nfb_user_portal\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\nfb_user_portal\civi_query\query_base;

class AdminImportForm extends FormBase
{
    public function getFormId()
    {
        // TODO: Implement getFormId() method.
    }
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        // TODO: Implement buildForm() method.
    }
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        // TODO: Implement submitForm() method.
    }
    public function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function create_user(FormStateInterface $form_state)
    {
        $language = \Drupal::languageManager()->getCurrentLanguage()->getId();
        $user = \Drupal\user\Entity\User::create();
        // set_up_needs
        $user->setPassword($this->generateRandomString());
        $user->enforceIsNew();
        $user->setEmail($form_state->getValue("email"));
        $user->setUsername($form_state->getValue("email"));
        // Optional.
        $user->set('init', 'email');
        $user->activate();

        // Save user account.
        $result = $user->save();
        $this->user_id = $user->id();
        $this->reset_link = user_pass_reset_url($user);
        \Drupal::logger("url_check")->notice("usl: ".$this->get_reset_link());
    }

    public function civi_user_set_up()
    {
        $civi = new query_base();
        $this->find_uf_match($civi);

    }

    public function find_uf_match(query_base $civi)
    {
        $civi->entity = "UFMatch";
        $civi->mode = "get";
        $civi->params = array(

            'select' => [
                '*',
            ],
            'where' => [
                ['uf_id', '=', $this->get_user_id()],
            ],
            'limit' => 25,
            'checkPermissions' => FALSE,

        );
        $civi->civi_api_v4_query();
        $result = $civi->get_civi_result();
        $count = $result->count();
        if ($count == 0) {
            $civi->mode = "create";
            $civi->params = array(
                'values' => [
                    'domain_id' => 1,
                    'uf_id' => $this->get_user_id(),
                    'contact_id' => $this->get_civi_id(),
                ],
                'checkPermissions' => FALSE,
            );
            $civi->civi_api_v4_query();
        } else {
            $uf_match = $result->first();
            $id = $uf_match['id'];
            $civi->mode = "update";
            $civi->params = array(
                'values' => [
                    'contact_id' => $this->get_civi_id(),
                ],
                'where' => [
                    ['id', '=', $id],
                ],
                'checkPermissions' => FALSE,
            );
            $civi->civi_api_v4_query();
        }
    }

    public function check_email_in_user(FormStateInterface $form_state)
    {
        $username = $form_state->getValue("email");

        $ids = \Drupal::entityQuery('user')
            ->condition('name', trim($username))
            ->range(0, 1)
            ->execute();
        if (!empty($ids)) {
            $exists = "Not New";
        } else {
            $exists = "New";
        }
        if($exists == "New")
        {
            \Drupal::logger("error_stuff")->notice("entity:  I get here");
            $ids = \Drupal::entityQuery('user')
                ->condition('mail', trim($username))
                ->range(0, 1)
                ->execute();
            if (!empty($ids)) {
                $exists = "Not New";
            } else {
                $exists = "New";
            }
        }
        if ($exists != "Not New") {
            $this->create_user($form_state);
            $this->civi_user_set_up();
        }

    }
}