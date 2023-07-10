<?php
Namespace Drupal\nfb_user_portal\html_builder\Admin;
use Drupal\Core\Form\FormStateInterface;

class edit_create_contnet
{
    public function build_form_array(&$form, FormStateInterface $form_state, $content)
    {
        $form['content_value'] = array(
            '#type' => 'textfield',
            '#value' => $content,
            '#size' => '20',
            '#attributes' => array('readonly' => 'readonly'),
            '#title' => "Content Id"
        );
        $form['markup_type']  = array(
            '#type' => "select",
            '#title' => "Markup Type",
            '#options' => array(
                'intro_text' => "Intro Text",
                "member_benefit" => "Member Benefit",
                'faq' => "FAQ",
                'content_text' => "Content Text"
            ),
            '#required' => "true"
        );
        $form['Markup_title'] = array(
            '#type' => "textfield",
            '#title' => "Content Title",
            '#required' => true,
            '#size' => "20"
        );
        $form['limited_by'] = array(
            '#type' => 'select',
            '#title' => "Markup Up Display Limited By?",
            '#required' => True,
            "#options" => array(
              'no' => "No Limit to Display",
              "civi_entity" => "Civi Group, Event, or Another Entity",
              "member" => "Active Members Only",
              "date" => "Date Range"
            ),
        );
        $form['civi_entity'] = array(
            '#type' => "select",
            '#title' => "Civi Entity",
            '#options' => array(
                'Event' => "By Event Registration",
                'Group' => "By Group",
                "Contact Type" => "By Contact Type or Occupation",
                "MemberhsipType" => "Certain Memberships Only"
                ),
            '#states' => [
                'visible' =>[
                    [':input[name="limited_by"]' => ['value' => "civi_entity"]],

                'and',
                'required' => [
                    [':input[name="limited_by"]' => ['value' => "civi_entity"]],
            ]]
                ],
        );
        $form['civi_entity_value'] = array(
            '#type' => 'textfield',
            '#title' => "Name of Civi Entity",
            '#size' => "20",
            '#states' => [
                'visible' =>[
                    [':input[name="limited_by"]' => ['value' => "civi_entity"]],

                    'and',
                    'required' => [
                        [':input[name="limited_by"]' => ['value' => "civi_entity"]],
                    ]]
            ],
        );
        $form['tab'] = array(
          '#type' => "select",
          "#title" => "What Member Portal Tab is This For?",
          "#required" => true,
          "#options" => array(
            'profile' => "Profile",
              "membership" => "Membership",
              "other" => "Other",
              "manage_account" => "Manage Account",
          ),

        );
        $form['start_date'] = array(
            '#type' => 'date',
            "#title" => "Display Start Date",

        );
        $form['end_date'] = array(
            '#type' => 'date',
            "#title" => "Display End Date",
            '#states' => [
                'visible' =>[
                    [':input[name="limited_by"]' => ['value' => "date"]],

                    'and',
                    'required' => [
                        [':input[name="limited_by"]' => ['value' => "date"]],
                    ]]
            ],
        );
        $form['active'] = array(
            '#type' => 'select',
            "#title" => "Active",
            '#required' => "True",
            "#options" => array(
              '0' => "Yes",
              "1" => "No"
            ),
        );
        $form['notes'] = array(

        );
        $form['content'] = array(
            '#type' => 'text_format',
            '#title' => 'Content',
            '#format'=> 'full_html',
        );



    }
}