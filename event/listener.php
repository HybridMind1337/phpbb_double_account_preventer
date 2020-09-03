<?php
namespace hybridmind\prevent_double_reg\event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class listener implements EventSubscriberInterface
{
    
    /** @var \phpbb\config\config */
    protected $config;
    
    /** @var \phpbb\template\template */
    protected $template;
    
    /** @var \phpbb\user */
    protected $user;
    
    protected $db;
    
    public function __construct(\phpbb\config\config $config, \phpbb\template\template $template, \phpbb\user $user, \phpbb\db\driver\driver_interface $db)
    {
        
        $this->config   = $config;
        $this->template = $template;
        $this->user     = $user;
        $this->db       = $db;
    }
    
    
    
    static public function getSubscribedEvents()
    {
        return array(
            'core.ucp_register_data_before' => 'checker_acc'
        );
    }
    
    public function checker_acc($event)
    {
        global $request;
        $useripz     = $request->server('REMOTE_ADDR');
        $sql2        = "SELECT user_ip FROM phpbb_users WHERE user_ip='$useripz'";
        $result2     = $this->db->sql_query($sql2);
        $forum_data2 = $this->db->sql_fetchrow($result2);
        $this->db->sql_freeresult($result2);
        
        if ($user->data['is_registered'] || isset($_REQUEST['not_agreed']) || $forum_data2 > 0) {
            trigger_error("<div class='rules'>Ти вече си регистриран или имаш акаунт!</div>");
        }
        
    }
    
}