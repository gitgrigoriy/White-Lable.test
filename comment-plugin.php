<?php 

/*
Plugin Name: Comment-plugin
Description: Плагин, создающий виджет, который выводит список пользователей из базы данных.
Version: Номер версии плагина, например: 1.0
Author: Гиревой Григорий

*/



/**
 * Adds Foo_Widget widget.
 */
class Foo_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'foo_widget', // Base ID
			esc_html__( 'Widget Title', 'text_domain' ), // Name
			array( 'description' => esc_html__( 'A Foo Widget', 'text_domain' ), ) // Args
		);
	}

/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		global $wpdb;

        $postCnt = intval($wpdb->get_var("SELECT COUNT(*) FROM wp_users")); //кол-во юзеров .
          
		?>
       <div class="field">
        <form action="" method = "POST">
            <input type="checkbox" name = "allU"><label >Все пользователи</label><br>
            <input type="checkbox" name = "UWC"><label>Пользователи, оставившие комментарий</label><br>
            <input type="checkbox" name = "UWTC"><label>Пользователи, не оставившие комментариев</label>
            <input type="checkbox" name = "COM" checked><label>Показывать комментарии</label>
<!--            <div class="btn" style="cursor: pointer; width:3vw; height:2vw; background-color:red; display:flex; align-items:center; justify-content:center;">Submit</div>-->
            <input type="submit" style="margin-top:10px; margin-bottom:10px;">
            <input type="number" min="1" max="<?php echo $postCnt ?>" value="1" name="usrscnt">
        </form>
        </div>
	    <ul>
	        <?php 
            $itsAll = isset($_POST['allU']);
            $itsWC = isset($_POST['UWC']);
            $itsWTC = isset($_POST['UWTC']);
            $itsCOM = isset($_POST['COM']);
            $wu = $_POST['usrscnt'];


            $i = 1; //intval($wpdb->get_var( "SELECT ID FROM wp_users" ))
            $j = 1;
            $m = 1;

            if($itsAll){
                while($i <= $wu){
                        $author = $wpdb->get_var( "SELECT user_nicename FROM wp_users WHERE ID = '$i'" );
                        $cc = intval($wpdb->get_var("SELECT COUNT(*) FROM wp_comments WHERE comment_author = '$author'"));
                        if($itsCOM){
                               echo "<li style= \"list-style:none;\">".$i.") <u>".$author."</u>  |  <i>Count of comments: </i><b style = \"font-weight:bold\">".$cc."</b></li>";
                            
                            }
                            else{
                            echo "<li style= \"list-style:none;\">".$i.") <u>".$author."</u></li>";
                            
                            }
                        $i++;
                }   
            }
            if($itsWC){
                while($i <= $wu){
                        $author = $wpdb->get_var( "SELECT user_nicename FROM wp_users WHERE ID = '$i'" );
                        $cc = intval($wpdb->get_var("SELECT COUNT(*) FROM wp_comments WHERE comment_author = '$author'"));
                        if($cc > 0){
                            if($itsCOM){
                               echo "<li style= \"list-style:none;\">".$j.") <u>".$author."</u>  |  <i>Count of comments: </i><b style = \"font-weight:bold\">".$cc."</b></li>";
                            $j++; 
                            }
                            else{
                            echo "<li style= \"list-style:none;\">".$j.") <u>".$author."</u></li>";
                            $j++; 
                            }
                        }
                        $i++;
                }   
            }
            
            if($itsWTC){
                while($i <= $wu){
                        $author = $wpdb->get_var( "SELECT user_nicename FROM wp_users WHERE ID = '$i'" );
                        $cc = intval($wpdb->get_var("SELECT COUNT(*) FROM wp_comments WHERE comment_author = '$author'"));
                       if($cc == 0){
                            if($itsCOM){
                               echo "<li style= \"list-style:none;\">".$j.") <u>".$author."</u>  |  <i>Count of comments: </i><b style = \"font-weight:bold\">".$cc."</b></li>";
                            $j++; 
                            }
                            else{
                            echo "<li style= \"list-style:none;\">".$j.") <u>".$author."</u></li>";
                            $j++; 
                            }
                        }
                        $i++;
                }   
            }
            ?>
           
         
	    </ul>
	<?php
	}
	

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'text_domain' );
		global $wpdb;

        $postCnt = intval($wpdb->get_var("SELECT COUNT(*) FROM wp_users")); //кол-во юзеров .
          
		?>
       <div class="field">
        <form action="" method = "POST">
            <input type="checkbox" name = "allU"><label >Все пользователи</label><br>
            <input type="checkbox" name = "UWC"><label>Пользователи, оставившие комментарий</label><br>
            <input type="checkbox" name = "UWTC"><label>Пользователи, не оставившие комментариев</label>
            <input type="checkbox" name = "COM" checked><label>Показывать комментарии</label>
<!--            <div class="btn" style="cursor: pointer; width:3vw; height:2vw; background-color:red; display:flex; align-items:center; justify-content:center;">Submit</div>-->
            <input type="submit" style="margin-top:10px; margin-bottom:10px;">
            <input type="number" min="1" max="<?php echo $postCnt ?>" value="1" name="usrscnt">
        </form>
        </div>
	    <ul>
	        <?php 
            $itsAll = isset($_POST['allU']);
            $itsWC = isset($_POST['UWC']);
            $itsWTC = isset($_POST['UWTC']);
            $itsCOM = isset($_POST['COM']);
            $wu = $_POST['usrscnt'];


            $i = 1; //intval($wpdb->get_var( "SELECT ID FROM wp_users" ))
            $j = 1;
            $m = 1;

            if($itsAll){
                while($i <= $wu){
                        $author = $wpdb->get_var( "SELECT user_nicename FROM wp_users WHERE ID = '$i'" );
                        $cc = intval($wpdb->get_var("SELECT COUNT(*) FROM wp_comments WHERE comment_author = '$author'"));
                        if($itsCOM){
                               echo "<li style= \"list-style:none;\">".$i.") <u>".$author."</u>  |  <i>Count of comments: </i><b style = \"font-weight:bold\">".$cc."</b></li>";
                            
                            }
                            else{
                            echo "<li style= \"list-style:none;\">".$i.") <u>".$author."</u></li>";
                            
                            }
                        $i++;
                }   
            }
            if($itsWC){
                while($i <= $wu){
                        $author = $wpdb->get_var( "SELECT user_nicename FROM wp_users WHERE ID = '$i'" );
                        $cc = intval($wpdb->get_var("SELECT COUNT(*) FROM wp_comments WHERE comment_author = '$author'"));
                        if($cc > 0){
                            if($itsCOM){
                               echo "<li style= \"list-style:none;\">".$j.") <u>".$author."</u>  |  <i>Count of comments: </i><b style = \"font-weight:bold\">".$cc."</b></li>";
                            $j++; 
                            }
                            else{
                            echo "<li style= \"list-style:none;\">".$j.") <u>".$author."</u></li>";
                            $j++; 
                            }
                        }
                        $i++;
                }   
            }
            
            if($itsWTC){
                while($i <= $wu){
                        $author = $wpdb->get_var( "SELECT user_nicename FROM wp_users WHERE ID = '$i'" );
                        $cc = intval($wpdb->get_var("SELECT COUNT(*) FROM wp_comments WHERE comment_author = '$author'"));
                       if($cc == 0){
                            if($itsCOM){
                               echo "<li style= \"list-style:none;\">".$j.") <u>".$author."</u>  |  <i>Count of comments: </i><b style = \"font-weight:bold\">".$cc."</b></li>";
                            $j++; 
                            }
                            else{
                            echo "<li style= \"list-style:none;\">".$j.") <u>".$author."</u></li>";
                            $j++; 
                            }
                        }
                        $i++;
                }   
            }
            ?>
           
         
	    </ul>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'text_domain' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

		return $instance;
	}

} // class Foo_Widget

// register Foo_Widget widget
function register_foo_widget() {
    register_widget( 'Foo_Widget' );
}
add_action( 'widgets_init', 'register_foo_widget' );

?>