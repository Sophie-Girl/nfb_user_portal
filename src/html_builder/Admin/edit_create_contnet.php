<?php
Namespace Drupal\nfb_user_portal\html_builder\Admin;
use Drupal\Core\Form\FormStateInterface;

class edit_create_contnet
{
    public function build_form_array(&$form, FormStateInterface $form_state)
    {
        $form['markup_type']  = array(
            '#type' => "select",
            '#title' => "Filter By Markup Type",
            '#options' => array(
                'intro_text' => "Intro Text",
                "member_benefit" => "Member Benefit",
                'faq' => "FAQ",
                'content_text' => "Content Text"
            ),
        );
    }
}