<?php
Namespace Drupal\nfb_user_portal\html_builder\Admin;
use Drupal\Core\Form\FormStateInterface;

class edit_create_contnet
{
    public function build_form_array(&$form, FormStateInterface $form_state)
    {
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

    }
}