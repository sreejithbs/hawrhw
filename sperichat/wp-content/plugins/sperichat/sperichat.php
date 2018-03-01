<?php

	/**
	 * Plugin Name: Spericorn Chat
	 * Plugin URI: http://www.google.com
	 * Description: Plugin for Chat
	 * Version: 1.0.0
	 * Author: Sreejith BS
	 * Author URI: http://www.google.com
	 * License: Copyright Protected
	 */


// Assigning capabilities to Admin, Author and Contributor
$admins = get_role('administrator');
if( $admins !== null ) {
	$admins->add_cap('sperichat_admin');
}

$authors = get_role('author');
if( $authors !== null ) {
	$authors->add_cap('sperichat_author');
}

$contributors = get_role('contributor');
if( $contributors !== null ) {
	$contributors->add_cap('sperichat_contributor');
}
// Assigning capabilities to Admin, Author and Contributor



// function to create the DB tables
function sperichat_table_install() {
   	global $wpdb;
  	global $chat_sessions, $chat_msgs;
  	$charset_collate = $wpdb->get_charset_collate();
	$chat_sessions = $wpdb->prefix . 'sperichat_chat_sessions';
	$chat_msgs = $wpdb->prefix . 'sperichat_chat_msgs';

	// create chat_sessions database table
	if($wpdb->get_var("show tables like '$chat_sessions'") != $chat_sessions)
	{
		$sql = "
			CREATE TABLE IF NOT EXISTS " . $chat_sessions . " (
				id int(11) NOT NULL AUTO_INCREMENT,
				timestamp datetime NOT NULL,
				name varchar(700) NOT NULL,
				email varchar(700) NOT NULL,
				ip varchar(700) NOT NULL,
				session varchar(100) NOT NULL,
				last_active_timestamp datetime NOT NULL,
				agent_id int(11) NOT NULL,
				PRIMARY KEY (id)
			) $charset_collate;
		";


		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
	}

	// create chat_msgs database table
	if($wpdb->get_var("show tables like '$chat_msgs'") != $chat_msgs)
	{
		$sql = "
			CREATE TABLE IF NOT EXISTS " . $chat_msgs . " (
				id int(11) NOT NULL AUTO_INCREMENT,
				chat_sess_id int(11) NOT NULL,
				msgfrom varchar(150) NOT NULL,
				msg longtext NOT NULL,
				timestamp datetime NOT NULL,
				originates int(3) NOT NULL,
				PRIMARY KEY  (id),
				FOREIGN KEY (chat_sess_id) REFERENCES ". $wpdb->prefix ."sperichat_chat_sessions(id) ON DELETE CASCADE
			) $charset_collate;
		";


		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
	}

}
register_activation_hook(__FILE__,'sperichat_table_install');
// function to create the DB tables





// Set plugin settings page inside Admin settings dropdown
function sperichat_admin_actions() {
    add_options_page("SperiChat", "SperiChat", "sperichat_contributor", "SperiChat", "adminfn");
}
add_action('admin_menu', 'sperichat_admin_actions');
// Set plugin settings page inside Admin settings dropdown

function adminfn(){ ?>
	<style type="text/css">
		*{
		  font-family:'Helvetica Neue',Helvetica, sans-serif;
		  font-size:14px;
		  margin:0;
		}
		a{
		  font-weight:bold;
		  color:#fff;
		  text-decoration:none;
		}
		.container{
		  width:400px;
		  display:block;
		  margin:0 auto;
		  box-shadow:0 2px 5px rgba(0,0,0,0.4);
		}
		.header{
		  padding:20px 20px 18px 20px;
		  background:#5FB471;
		  color:#fff;
		}
		.header h2{
		  font-size:16px;
		  line-height:15px;
		  display:inline-block;
		}
		.header a{
		  display:inline-block;
		  float:right;
		  background:#3d8b4e;
		  font-size:25px;
		  line-height:20px;
		  padding:3px 6px;
		  margin-top:-5px;
		  border-radius:2px;
		}
		.chat-box, .enter-message{
		  background:#ECECEC;
		  padding:0 20px;
		  color:#a1a1a1;
		}
		.chat-box .message-box{
		  padding:18px 0 10px;
		  clear:both;

		}
		.message-box .picture{
		  float:left;
		  width:50px;
		  display:block;
		  padding-right:10px;
		}
		.picture img{
		  width:43px;
		  height:48px;
		  border-radius:5px;
		}
		.picture span{
		  font-weight:bold;
		  font-size:12px;
		  clear:both;
		  display:block;
		  text-align:center;
		  margin-top:3px;
		}
		.message{
		  background:#fff;
		  display:inline-block;
		  padding:13px;
		  width:274px;
		  border-radius:2px;
		  box-shadow: 0 1px 1px rgba(0,0,0,.04);
		  position:relative;
		}
		.message:before{
		  content:"";
		  position:absolute;
		  display:block;
		  left:0;
		  border-right:6px solid #fff;
		  border-top: 6px solid transparent;
		  border-bottom:6px solid transparent;
		  top:10px;
		  margin-left:-6px;
		}
		.message span{
		  color:#555;
		  font-weight:bold;
		}
		.message p{
		  padding-top:5px;
		}
		.message-box.right-img .picture{
		  float:right;
		  padding:0;
		  padding-left:10px;
		}
		.message-box.right-img .picture img{
		  float:right;
		}
		.message-box.right-img .message:before{
		  left:100%;
		  margin-right:6px;
		  margin-left:0;
		  border-right:6px solid transparent;
		  border-left:6px solid #fff;
		  border-top: 6px solid transparent;
		  border-bottom:6px solid transparent;
		}
		.enter-message{
		  padding:13px 0px;
		}
		.enter-message input{
		  border:none;
		  padding:10px 12px;
		  background:#d3d3d3;
		  width:260px;
		  border-radius:2px;
		}
		.enter-message a.send{
		  padding:10px 15px;
		  background:#6294c2;
		  border-radius:2px;
		  float:right;
		}
	</style>

	<div class="container">
	  <div class="header">
	    <h2>Messages</h2>
	  </div>
	  <div class="chat-box">
	    <div class="message-box left-img">
	      <div class="picture">
	        <img src="http://0.gravatar.com/avatar/395fc9403b516c9cb85599849119770a?s=96&d=mm&r=g" title="user name"/>
	        <span class="time">10 mins</span>
	      </div>
	      <div class="message">
	        <span>Bobby</span>
	        <p>Hey, how are you doing?</p>
	      </div>
	    </div>
	    <div class="message-box right-img">
	      <div class="picture">
	        <img src="http://0.gravatar.com/avatar/395fc9403b516c9cb85599849119770a?s=96&d=mm&r=g" title="user name"/>
	        <span class="time">2 mins</span>
	      </div>
	      <div class="message">
	        <span>Alice</span>
	        <p>Pretty good.</p>
	      </div>
	    </div>
	   </div>

	    <div class="enter-message">
	      <input type="text" id="chat_text" autofocus placeholder="Enter your message.."/>
	      <a href="javascript:void(0);" class="send">Send Message</a>
	    </div>
	</div>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){

			$(".send").click(function() {
				var dateTime = getTime();
				var txt = $("#chat_text").val();
				if(txt){
					$(".chat-box").append(' <div class="message-box right-img"><div class="picture"><img src="http://0.gravatar.com/avatar/395fc9403b516c9cb85599849119770a?s=96&d=mm&r=g" title="user name"/><span class="time">' +dateTime.date+ '</br>' +dateTime.time+ '</span></div><div class="message"><span>Alice</span><p>' +txt+ '</p></div></div>');
					$("#chat_text").val("");
					$("#chat_text").focus();

				}else{

				}
			});
		});

		function getTime(){
			var now = new Date();
			var dd = now.getDate();
			var mm = now.getMonth() + 1; //January is 0!

			var yyyy = now.getFullYear();
			if(dd<10){
				dd='0'+dd;
			}
			if(mm<10){
				mm='0'+mm;
			}

			var date = mm+'/'+dd+'/'+yyyy;

			var time = now.getHours() + ":" + now.getMinutes() + ":" + now.getSeconds();

			return {date: date, time: time};
		}

	</script>
<?php }














function adminfn2(){ ?>

	<style type="text/css">
	/*.chat-box {
	    position:fixed;
	    right:15px;
	    bottom:0;
	    box-shadow:0 0 0.1em #000;
	}

	.chat-closed {
	    width: 250px;
	    height: 35px;
	    background: #8bc34a;
	    line-height: 35px;
	    font-size: 18px;
	    text-align: center;
	    border:1px solid #777;
	    color: #000;
	}*/

	.chat-header {
	    width: 550px;
	    height: 35px;
	    background: #8bc34a;
	    line-height: 33px;
	    text-indent: 20px;
	    border:1px solid #777;
	    border-bottom:none;
	}

	.chat-content{
	    width:550px;
	    height:300px;
	    background:#ffffff;
	    border:1px solid #777;
	    overflow-y:auto;
	    word-wrap: break-word;
	}

	.box{
	    width:10px;
	    height:10px;
	    background:green;
	    float:left;
	    position:relative;
	    top: 11px;
	    left: 10px;
	    border:1px solid #ededed;
	}

	/*body {
	    margin: 0 auto;
	    max-width: 800px;
	    padding: 0 20px;
	}*/

	.container {
	    border: 2px solid #dedede;
	    background-color: #f1f1f1;
	    border-radius: 5px;
	    padding: 10px;
	    margin: 10px 0;
	}

	.darker {
	    border-color: #ccc;
	    background-color: #ddd;
	}

	.container::after {
	    content: "";
	    clear: both;
	    display: table;
	}

	.container img {
	    float: left;
	    max-width: 60px;
	    width: 100%;
	    margin-right: 20px;
	    border-radius: 50%;
	}

	.container img.right {
	    float: right;
	    margin-left: 20px;
	    margin-right:0;
	}

	.time-right {
	    float: right;
	    color: #aaa;
	}

	.time-left {
	    float: left;
	    color: #999;
	}

	/*.hide {
	    display:none;
	}*/
	</style>
	</head>
	<body>
		<div class="wrap">

		    <div class="chat-header hide"><div class="box"></div>Online Support</div>
		    	<div class="chat-content hide">
		    		<div class="container">
		    		  <img src="/w3images/bandmember.jpg" alt="Avatar" style="width:100%;">
		    		  <p>Hello. How are you today?</p>
		    		  <span class="time-right">11:00</span>
		    		</div>

		    		<div class="container darker">
		    		  <img src="/w3images/avatar_g2.jpg" alt="Avatar" class="right" style="width:100%;">
		    		  <p>Hey! I'm fine. Thanks for asking!</p>
		    		  <span class="time-left">11:01</span>
		    		</div>

		    		<div class="container">
		    		  <img src="/w3images/bandmember.jpg" alt="Avatar" style="width:100%;">
		    		  <p>Sweet! So, what do you wanna do today?</p>
		    		  <span class="time-right">11:02</span>
		    		</div>

		    		<div class="container darker">
		    		  <img src="/w3images/avatar_g2.jpg" alt="Avatar" style="width:100%;">
		    		  <p>Nah, I dunno. Play soccer.. or learn more coding perhaps?</p>
		    		  <span class="time-left">11:05</span>
		    		</div>

		    	</div>
		    </div>

		</div>


	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript">
	// $(document).ready(function(){
	//     $(".chat-closed").on("click",function(e){
	//         $(".chat-header,.chat-content").removeClass("hide");
	//         $(this).addClass("hide");
	//     });

	//     $(".chat-header").on("click",function(e){
	//         $(".chat-header,.chat-content").addClass("hide");
	//         $(".chat-closed").removeClass("hide");
	//     });
	// });
	</script>
	</body>

	</html>
<?php }
















// Include File for Admin-Table inheritance
if(!class_exists('WP_List_Table')){
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

// Chat History listing page for sub-admin
class Chat_History_List_Table extends WP_List_Table {

    /** ************************************************************************
     * REQUIRED. Set up a constructor that references the parent constructor. We
     * use the parent reference to set some default configs.
     ***************************************************************************/
    function __construct(){
        global $status, $page;

        //Set parent defaults
        parent::__construct( array(
            'singular'  => 'Chat History',     //singular name of the listed records
            'plural'    => 'Chat Histories',    //plural name of the listed records
            'ajax'      => false        //does this table support ajax?
        ) );
    }


    /** ************************************************************************
     * Recommended. This method is called when the parent class can't find a method
     * specifically build for a given column. Generally, it's recommended to include
     * one method for each column you want to render, keeping your package class
     * neat and organized. For example, if the class needs to process a column
     * named 'title', it would first see if a method named $this->column_title()
     * exists - if it does, that method will be used. If it doesn't, this one will
     * be used. Generally, you should try to use custom column methods as much as
     * possible.
     *
     * Since we have defined a column_title() method later on, this method doesn't
     * need to concern itself with any column with a name of 'title'. Instead, it
     * needs to handle everything else.
     *
     * For more detailed insight into how columns are handled, take a look at
     * WP_List_Table::single_row_columns()
     *
     * @param array $item A singular item (one full row's worth of data)
     * @param array $column_name The name/slug of the column to be processed
     * @return string Text or HTML to be placed inside the column <td>
     **************************************************************************/
    function column_default($item, $column_name){
        switch($column_name){
            case 'email':
                return $item[$column_name];
            default:
                return print_r($item,true); //Show the whole array for troubleshooting purposes
        }
    }


    /** ************************************************************************
     * Recommended. This is a custom column method and is responsible for what
     * is rendered in any column with a name/slug of 'title'. Every time the class
     * needs to render a column, it first looks for a method named
     * column_{$column_title} - if it exists, that method is run. If it doesn't
     * exist, column_default() is called instead.
     *
     * This example also illustrates how to implement rollover actions. Actions
     * should be an associative array formatted as 'slug'=>'link html' - and you
     * will need to generate the URLs yourself. You could even ensure the links
     *
     *
     * @see WP_List_Table::::single_row_columns()
     * @param array $item A singular item (one full row's worth of data)
     * @return string Text to be placed inside the column <td> (movie title only)
     **************************************************************************/
    function column_title($item){

        //Build row actions
        $actions = array(
            'edit'      => sprintf('<a href="?page=%s&action=%s&newsletter=%s">Edit</a>',$_REQUEST['page'],'edit',$item['ID']),
            'delete'    => sprintf('<a href="?page=%s&action=%s&newsletter=%s">Delete</a>',$_REQUEST['page'],'delete',$item['ID']),
        );

        //Return the title contents
        return sprintf('%1$s <span style="color:silver">(id:%2$s)</span>%3$s',
            /*$1%s*/ $item['title'],
            /*$2%s*/ $item['ID'],
            /*$3%s*/ $this->row_actions($actions)
        );
    }


    /** ************************************************************************
     * REQUIRED if displaying checkboxes or using bulk actions! The 'cb' column
     * is given special treatment when columns are processed. It ALWAYS needs to
     * have it's own method.
     *
     * @see WP_List_Table::::single_row_columns()
     * @param array $item A singular item (one full row's worth of data)
     * @return string Text to be placed inside the column <td> (movie title only)
     **************************************************************************/
    function column_cb($item){
        return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            /*$1%s*/ $this->_args['singular'],  //Let's simply repurpose the table's singular label ("movie")
            /*$2%s*/ $item['id']                //The value of the checkbox should be the record's id
        );
    }


    /** ************************************************************************
     * REQUIRED! This method dictates the table's columns and titles. This should
     * return an array where the key is the column slug (and class) and the value
     * is the column's title text. If you need a checkbox for bulk actions, refer
     * to the $columns array below.
     *
     * The 'cb' column is treated differently than the rest. If including a checkbox
     * column in your table you must create a column_cb() method. If you don't need
     * bulk actions or checkboxes, simply leave the 'cb' entry out of your array.
     *
     * @see WP_List_Table::::single_row_columns()
     * @return array An associative array containing column information: 'slugs'=>'Visible Titles'
     **************************************************************************/
    function get_columns(){
        $columns = array(
            'cb'        => '<input type="checkbox" />', //Render a checkbox instead of text
            'email'     => 'xyz Emails',
        );
        return $columns;
    }


    /** ************************************************************************
     * Optional. If you want one or more columns to be sortable (ASC/DESC toggle),
     * you will need to register it here. This should return an array where the
     * key is the column that needs to be sortable, and the value is db column to
     * sort by. Often, the key and value will be the same, but this is not always
     * the case (as the value is a column name from the database, not the list table).
     *
     * This method merely defines which columns should be sortable and makes them
     * clickable - it does not handle the actual sorting. You still need to detect
     * the ORDERBY and ORDER querystring variables within prepare_items() and sort
     * your data accordingly (usually by modifying your query).
     *
     * @return array An associative array containing all the columns that should be sortable: 'slugs'=>array('data_values',bool)
     **************************************************************************/
    function get_sortable_columns() {
        $sortable_columns = array(
            'email'     => array('email',false),     //true means it's already sorted
        );
        return $sortable_columns;
    }


    /** ************************************************************************
     * Optional. If you need to include bulk actions in your list table, this is
     * the place to define them. Bulk actions are an associative array in the format
     * 'slug'=>'Visible Title'
     *
     * If this method returns an empty value, no bulk action will be rendered. If
     * you specify any bulk actions, the bulk actions box will be rendered with
     * the table automatically on display().
     *
     * Also note that list tables are not automatically wrapped in <form> elements,
     * so you will need to create those manually in order for bulk actions to function.
     *
     * @return array An associative array containing all the bulk actions: 'slugs'=>'Visible Titles'
     **************************************************************************/
    function get_bulk_actions() {
        $actions = array(
            'delete'    => 'Delete entries',
            'export'    => 'Export as CSV'
        );
        return $actions;
    }


    /** ************************************************************************
     * Optional. You can handle your bulk actions anywhere or anyhow you prefer.
     * For this example package, we will handle it in the class to keep things
     * clean and organized.
     *
     * @see $this->prepare_items()
     **************************************************************************/
    function process_bulk_action() {

        global $wpdb;

        if ( 'export' === $this->current_action() ) {
          exportfn('newsletter');
        }

        if (isset( $_POST['newsletteremail'])){
            //Detect when a bulk action is being triggered...
            if ( 'delete' === $this->current_action() ) {

                $delete_ids = esc_sql( $_POST['newsletteremail'] );

              // loop over the array of record IDs and delete them
                foreach ( $delete_ids as $id ) {
                    $delete_result = $wpdb->query("DELETE FROM newsletter WHERE id = '$id'");
                }
            }
        }
    }


    /** ************************************************************************
     * REQUIRED! This is where you prepare your data for display. This method will
     * usually be used to query the database, sort and filter the data, and generally
     * get it ready to be displayed. At a minimum, we should set $this->items and
     * $this->set_pagination_args(), although the following properties and methods
     * are frequently interacted with here...
     *
     * @global WPDB $wpdb
     * @uses $this->_column_headers
     * @uses $this->items
     * @uses $this->get_columns()
     * @uses $this->get_sortable_columns()
     * @uses $this->get_pagenum()
     * @uses $this->set_pagination_args()
     **************************************************************************/
    function prepare_items() {
        global $wpdb; //This is used only if making any database queries

        /**
         * First, lets decide how many records per page to show
         */
        $per_page = 25;

        /**
         * REQUIRED. Now we need to define our column headers. This includes a complete
         * array of columns to be displayed (slugs & titles), a list of columns
         * to keep hidden, and a list of columns that are sortable. Each of these
         * can be defined in another method (as we've done here) before being
         * used to build the value for our _column_headers property.
         */
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();

        /**
         * REQUIRED. Finally, we build an array to be used by the class for column
         * headers. The $this->_column_headers property takes an array which contains
         * 3 other arrays. One for all columns, one for hidden columns, and one
         * for sortable columns.
         */
        $this->_column_headers = array($columns, $hidden, $sortable);

        /**
         * Optional. You can handle your bulk actions however you see fit. In this
         * case, we'll handle them within our package just to keep things clean.
         */
        $this->process_bulk_action();

        /**
         * Instead of querying a database, we're going to fetch the example data
         * property we created for use in this plugin. This makes this example
         * package slightly different than one you might build on your own. In
         * this example, we'll be using array manipulation to sort and paginate
         * our data. In a real-world implementation, you will probably want to
         * use sort and pagination data to build a custom query instead, as you'll
         * be able to use your precisely-queried data immediately.
         */

        $data = $wpdb->get_results("SELECT * FROM newsletter", ARRAY_A);

        /**
         * This checks for sorting input and sorts the data in our array accordingly.
         *
         * In a real-world situation involving a database, you would probably want
         * to handle sorting by passing the 'orderby' and 'order' values directly
         * to a custom query. The returned data will be pre-sorted, and this array
         * sorting technique would be unnecessary.
         */
        function usort_reorder($a,$b){
            $orderby = (!empty($_REQUEST['orderby'])) ? $_REQUEST['orderby'] : 'id'; //If no sort, default to title
            $order = (!empty($_REQUEST['order'])) ? $_REQUEST['order'] : 'desc'; //If no order, default to asc
            $result = strcmp($a[$orderby], $b[$orderby]); //Determine sort order
            return ($order === 'asc') ? $result : -$result; //Send final sort direction to usort
        }
        usort($data, 'usort_reorder');


        /***********************************************************************
         * ---------------------------------------------------------------------
         * vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
         *
         * In a real-world situation, this is where you would place your query.
         *
         * For information on making queries in WordPress, see this Codex entry:
         * http://codex.wordpress.org/Class_Reference/wpdb
         *
         * ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
         * ---------------------------------------------------------------------
         **********************************************************************/


        /**
         * REQUIRED for pagination. Let's figure out what page the user is currently
         * looking at. We'll need this later, so you should always include it in
         * your own package classes.
         */
        $current_page = $this->get_pagenum();

        /**
         * REQUIRED for pagination. Let's check how many items are in our data array.
         * In real-world use, this would be the total number of items in your database,
         * without filtering. We'll need this later, so you should always include it
         * in your own package classes.
         */
        $total_items = count($data);


        /**
         * The WP_List_Table class does not handle pagination for us, so we need
         * to ensure that the data is trimmed to only the current page. We can use
         * array_slice() to
         */
        $data = array_slice($data,(($current_page-1)*$per_page),$per_page);


        /**
         * REQUIRED. Now we can add our *sorted* data to the items property, where
         * it can be used by the rest of the class.
         */
        $this->items = $data;


        /**
         * REQUIRED. We also have to register our pagination options & calculations.
         */
        $this->set_pagination_args( array(
            'total_items' => $total_items,                  //WE have to calculate the total number of items
            'per_page'    => $per_page,                     //WE have to determine how many items to show on a page
            'total_pages' => ceil($total_items/$per_page)   //WE have to calculate the total number of pages
        ) );
    }
}

/** ************************ REGISTER THE PAGE ****************************
 * Now we just need to define an admin page. For this example, we'll add a top-level
 * menu item to the bottom of the admin menus.
 */
function chat_add_menu_items(){
    add_menu_page('Chat History', 'Chat History', 'sperichat_author', 'chat_add_menu_items_slug', 'chat_render_list_page');
}
add_action('admin_menu', 'chat_add_menu_items');


/** *************************** RENDER PAGE ********************************
 * This function renders the admin page and the example list table. Although it's
 * possible to call prepare_items() and display() from the constructor, there
 * are often times where you may need to include logic here between those steps,
 * so we've instead called those methods explicitly. It keeps things flexible, and
 * it's the way the list tables are used in the WordPress core.
 */
function chat_render_list_page(){

    //Create an instance of our package class...
    $chatListTable = new Chat_History_List_Table();
    //Fetch, prepare, sort, and filter our data...
    $chatListTable->prepare_items();

    ?>
    <div class="wrap">

        <div id="icon-users" class="icon32"><br/></div>
        <h2>Chat History</h2>

        <!-- Forms are NOT created automatically, so you need to wrap the table in one to use features like bulk actions -->
        <form id="chat_formID" method="POST">
            <!-- For plugins, we also need to ensure that the form posts back to our current page -->
            <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
            <!-- Now we can render the completed list table -->
            <?php $chatListTable->display() ?>
        </form>

    </div>
    <?php
}
// Chat History listing page for sub-admin


// EXPORT FUNCTION
ob_start(); //Important

function exportfn($table){

  global $wpdb;

  $query = "SELECT * from $table";

  $retrieve_header = $wpdb->get_results($query);
  $retrieve_data = $wpdb->get_results($query, ARRAY_A);
  ob_clean();  //Important

  $csv_fields = array();
  foreach ( $wpdb->get_col( "DESC " . $table, 0 ) as $column_name ) {
    $fields = str_replace("_", " ", $column_name);
    $csv_fields[] = ucwords($fields);
  }

  $output_handle = fopen( 'php://output', 'w' );

  header("Pragma: public");
  header("Expires: 0");
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header("Cache-Control: private", false);
  header("Content-Type: application/octet-stream");
  header("Content-Disposition: attachment; filename=\"Report_". $table. "_". date('Y-m-d') .".csv\";");
  header("Content-Transfer-Encoding: binary");

  fputcsv( $output_handle, $csv_fields );
  foreach ($retrieve_data as $single_data) {
    fputcsv( $output_handle, $single_data );
  }
  exit;
}
// EXPORT FUNCTION
