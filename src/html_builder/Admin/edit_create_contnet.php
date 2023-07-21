<?php
Namespace Drupal\nfb_user_portal\html_builder\Admin;
use Drupal\Core\Form\FormStateInterface;
use Drupal\nfb_civicrm_bridge\civicrm\query;
use Drupal\nfb_user_portal\civi_query\query_base;
use Drupal\nfb_user_portal\SQL\admin\User_request_queries;
class edit_create_contnet
{
    /**
     * The user requezst query
     *
     * @var \Drupal\nfb_user_portal\SQL\admin\User_request_queries
     */
    protected $user_request_queries;
     /**
      * Constructs a new content form
      *
      * @param \Drupal\nfb_user_portal\SQL\admin\User_request_queries $user_request_queriea
      *   Sql functions
      *
      **/
     public function __construct(User_request_queries  $user_request_queries)
     {
         $this->user_request_queries = $user_request_queries;
     }
     public $cid; // store content_id
     public function get_cid()
     { return $this->cid;}
    public $markup_type; // store markup type
     public  function  get_markup_type()
     {return $this->markup_type;}
    public $tab; // tab content gets displayed on
     public function get_tab()
     {return $this->tab;}
    public $limiter; // restriction
     public function get_limiter()
     {return $this->limiter;}
     public $civi_entity;
     public function get_civi_entity()
     {return $this->civi_entity;}
    public $beginning_date;
     public function get_beginning_date()
     {return $this->beginning_date;}
    public $ending_date;
     public function get_ending_date()
    {return $this->ending_date;}
    public $active;
     public function get_active()
     {return $this->active;}
    public $title;
     public function  get_title()
    {return $this->title;}
    public $markup_text;
     public function get_markup_text()
     {return $this->markup_text;}
    public $weight;
     public function get_weight()
     {return $this->weight;}
    public  $permanent;
     public function get_permanent()
     {
         return $this->permanent;
     }
     public $group;
     public function get_group()
     {return $this->group;}
    public function build_form_array(&$form, FormStateInterface $form_state, $content)
    {
        $this->find_content_record($content);
        $form['content_value'] = array(
            '#type' => 'textfield',
            '#value' => $content,
            '#size' => '20',
            '#attributes' => array('readonly' => 'readonly'),
            '#title' => "Content Id"
        );
        $form['markup_type']  = array(
            '#prefix' => "<div id='mk_type' class='hidden_val'>".$this->get_markup_type()."</div>",
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
        $form['markup_title'] = array(
            '#prefix' => "<div class='hidden_val' id='title_val'>".$this->get_title()."</div>",
            '#type' => "textfield",
            '#title' => "Content Title",
            '#required' => true,
            '#size' => "20"
        );
        $form['limited_by'] = array(
            '#prefix' => "<div class='hidden_val' id='limit_val' >".$this->get_limiter()."</div>",
            '#type' => 'select',
            '#title' => "Markup Up Display Limited By?",
            '#required' => True,
            "#options" => array(
              'no' => "No Limit to Display",
              "civi_entity" => "Civi Group, Event, or Another Entity",
              "member" => "Active Members Only",
            ),
        );
        $form['civi_entity'] = array(
            '#prefix' => "<div class='hidden_val' id='civi_ent'  >".$this->get_civi_entity()."</div>",
            '#type' => "select",
            '#title' => "Civi Entity",
            '#options' => array(
                'Event' => "By Event Registration",
                'Group' => "By Group",
                "MembershipType" => "Certain Memberships Only"
                ),
            '#ajax' => array(
                'callback' => "::option_reset",
                'wrapper' => "ajax_wrap",
                'event' => 'change',),
            '#states' => [
                'visible' =>[
                    [':input[name="limited_by"]' => ['value' => "civi_entity"]],
],
                'and',
                'required' => [
                    [':input[name="limited_by"]' => ['value' => "civi_entity"]],
            ]
                ],
        );
        $form['civi_entity_value'] = array(
            '#prefix' => "<div class='hidden_val' id='civi_value' >".$this->get_civi_entity()."</div>
<div id='ajax_wrap'>",
            '#type' => 'select',
            '#title' => "Name of Civi Entity",
            '#options' => $this->civi_entity_options($form_state),
            '#states' => [
                'visible' =>[
                    [':input[name="limited_by"]' => ['value' => "civi_entity"]],
],
                    'and',
                    'required' => [
                        [':input[name="limited_by"]' => ['value' => "civi_entity"]],
                    ]
            ],
            '#suffix' => "</div>"
        );
        $form['tab'] = array(
            '#prefix' => "<div class='hidden_val' id='tab_val' >".$this->get_tab()."</div>",
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
            '#prefix' => "<div class='hidden_val' id='start_val' >".$this->get_beginning_date()."</div>",
            '#type' => 'date',
            "#title" => "Display Start Date",
            '#states' => [
                'visible' =>[
                    [':input[name="markup_type"]' => ['value' => "member_benefit"]],
],
                    'and',
                    'required' => [
                        [':input[name="markup_type"]' => ['value' => "member_benefit"]],
                    ]
            ],
        );
        $form['end_date'] = array(
            '#prefix' => "<div class='hidden_val' id='end_val' >".$this->get_ending_date()."</div>",
            '#type' => 'date',
            "#title" => "Display End Date",
            '#states' => [
                'visible' =>[
                    [':input[name="markup_type"]' => ['value' => "member_benefit"]],
],
                    'and',
                    'required' => [
                        [':input[name="markup_type"]' => ['value' => "member_benefit"]],
                    ]
            ],
        );
        $form['permanent'] = array(
            '#prefix' => "<div class='hidden_val' id='perm_val' >".$this->get_permanent()."</div>",
            '#type' => 'select',
            "#title" => "Is this markup Permanent?",
            '#required' => "True",
            "#options" => array(
                '0' => "Yes",
                "1" => "No"
            ),
        );
        $form['active'] = array(
                '#prefix' => "<div class='hidden_val' id='act_val' >".$this->get_active()."</div>",
            '#type' => 'select',
            "#title" => "Active",
            '#required' => "True",
            "#options" => array(
              '0' => "Yes",
              "1" => "No"
            ),
        );
        $form['content'] = array(
            '#prefix' => "<div>".$this->get_markup_text()."</div>",
            '#type' => 'text_format',
            '#title' => 'Content',
            '#format'=> 'full_html',
        );
        $form['faq_grouping'] = array(
            '#prefix' => "<div class='hidden_val' id='gpf_val' >".$this->get_group()."</div>",
            '#type' => 'textfield',
            "#title" => "FAQ Group",
            '#states' => [
                'visible' =>[
                    [':input[name="markup_type"]' => ['value' => "faq"]],
                ],
                'and',
                'required' => [
                    [':input[name="markup_type"]' => ['value' => "faq"]],
                ]
            ],
        );
        $form['benefit_group'] = array(
            '#prefix' => "<div class='hidden_val' id='bgp_val' >".$this->get_group()."</div>",
            '#type' => 'textfield',
            "#title" => "Benefit Group",
            '#states' => [
                'visible' =>[
                    [':input[name="markup_type"]' => ['value' => "member_benefit"]],
                ],
                'and',
                'required' => [
                    [':input[name="markup_type"]' => ['value' => "member_benefit"]],
                ]
            ],
        );
        if($content == "new")
        {
            $text = "Create";
        }
        else {
            $text = "Edit";
        }
        $form['weight'] = array(
            '#prefix' => "<div class='hidden_val' id='weight_val' >".$this->get_weight()."</div>",
            '#type' => 'select',
            '#title' => "Weight (Order for it to be displayed",
            '#required' => True,
            "#options" => array(
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6',
                '7' => '7',
                '8' => '8',
                '9' => '9',
                '10' => '10',
                '11' => '11',
                '12' => '12',
                '13' => '13',
                "14" => "14",
                "15" => "15"
            ),
        );
        $form['submit'] = array(
            '#type' => 'submit',
            '#value' => $text,);
    }
    public function find_content_record($content)
    {
        if($content != "new") {
            $this->content_query($content);
        }
        else{
            $this->blank_values($content);
        }
    }
    public function set_prefill_values($markup, $array)
    {
        $this->cid = $markup['cid'];
        $this->markup_type = $markup['markup_type'];
        $this->limiter = $markup['limiter'];
        $this->civi_entity = $markup['civi_entity'];
        $this->tab = $markup['tab'];
        $this->beginning_date = $markup['beginning_date'];
        $this->ending_date = $markup['end_date'];
        $this->active = $markup['active'];
        $this->permanent = $markup['permanent'];
        $this->title = $array['title'];
        $this->markup_text = $array['text'];
        $this->group = $array['group'];
        \Drupal::logger("content_issue")->notice("content_text ". $array['text']);
        $this->weight = $array['weight'];
    }
    public function blank_values($content)
    {
        $this->cid = $content;
        $this->markup_type = "new";
        $this->limiter = "new";
        $this->civi_entity = "new";
        $this->tab = "new";
        $this->beginning_date = "new";
        $this->ending_date = "new";
        $this->active = "new";
        $this->title = "new";
        $this->markup_text ="new";
        $this->weight = "new";
        $this->group = "new";
        $this->permanent = "new";
    }
    public function content_query($content)
    {
        $query = "Select * from nfb_user_portal_content where cid = '" . $content . "'";
        $key = 'cid';
        $this->user_request_queries->select_query($query, $key);
        foreach ($this->user_request_queries->get_result() as $markup)
        {
            $markup = get_object_vars($markup);
           \Drupal::logger("nfb-user_portal_check")->notice("array ".print_r($markup, true));
            $array = json_decode($markup['markup']);
            $array = get_object_vars($array);
            $this->set_prefill_values($markup, $array);
        }
    }
    public function civi_entity_options(FormStateInterface $form_state)
    {
        if($form_state->getValue("civi_entity") == "")
        {
            $options = array(
              ''   => "- Select -"
            );
        }
        else{
            $options = $this->creation_of_entity_options($form_state);
        }
       return $options;

    }
    public function creation_of_entity_options(FormStateInterface $form_state)
    {
        $civi = new query_base();
        $civi->entity = $form_state->getValue("civi_entity");
        $civi->mode = "get";
        $options = $this->switch_for_params($civi);
        return $options;
    }
    public function switch_for_params(query_base $civi)
    {
        switch ($civi->get_entity())
        {
            case "Event":
                $civi->params = [
                    'select' => [
                        'id',
                        'title',
                    ],
                    'limit' => 750,
                    'checkPermissions' => FALSE,
                ];
                break;
            case "MembershipType":
                $civi->params = [
                    'select' => [
                        'id',
                        'name',
                    ],
                    'limit' => 1000,
                    'checkPermissions' => FALSE,
                ];
                break;
            case "Group":
                $civi->params = [
                    'select' => [
                        'id',
                        'title',
                    ],
                    'limit' => 1000,
                    'checkPermissions' => FALSE,
                ];
                break;
        }
        if($civi->get_params())
        {
            $option[''] = "- Select -";
            $civi->civi_api_v4_query();
            $result = $civi->get_civi_result();
            $count = $result->count();
            $current = 0;
            while($current >= $count)
            {
                $entity = $result->itemat($current);
                if($civi->get_entity() == "MembershipType")
                {
                    if($entity['id'] != '')
                    {
                        $option[$entity['id']] = $entity['name'];
                    }
                }
                else{
                    if($entity['id'] != '')
                    {
                        $option[$entity['id']] = $entity['title'];
                    }
                }
            }
            return $option;
        }
    }

}