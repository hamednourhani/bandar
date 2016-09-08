<?php

function itstar_create_account(){
    //You may need some data validation here

    global $wpdb;
    global $user_errors;
    $user_errors = new WP_Error();


    $fname = esc_attr(( isset($_POST['fname']) ? $_POST['fname'] : '' ));
    $lname = esc_attr(( isset($_POST['lname']) ? $_POST['lname'] : '' ));
    $user = esc_attr(( isset($_POST['uname']) ? $_POST['uname'] : '' ));
    $birthday = esc_attr(( isset($_POST['birthday']) ? $_POST['birthday'] : '' ));
    $birthmonth = esc_attr(( isset($_POST['birthmonth']) ? $_POST['birthmonth'] : '' ));
    $birthyear = esc_attr(( isset($_POST['birthyear']) ? $_POST['birthyear'] : '' ));
    $job = esc_attr(( isset($_POST['job']) ? $_POST['job'] : '' ));
    $phone = esc_attr(( isset($_POST['phone']) ? $_POST['phone'] : '' ));
    $pass = esc_attr(( isset($_POST['upass']) ? $_POST['upass'] : '' ));
    $email = esc_attr(( isset($_POST['uemail']) ? $_POST['uemail'] : '' ));
    $aspam = esc_attr(( isset($_POST['aspam']) ? $_POST['aspam'] : '' ));
    $aspam_result = esc_attr(( isset($_POST['aspam_result']) ? $_POST['aspam_result'] : '' ));
    $submited = esc_attr(( isset($_POST['submited']) ? $_POST['submited'] : '' ));




    if($email && $pass && $user){

        // if( $birthday && (!is_int($birthday) || $birthday < 1 || $birthday > 31)){
        //   $user_errors->add( 'birthday',__('Birth Day must be a number between 1 & 31','itstar'),$birthday );
        //   var_dump(is_int($birthday));

        // }
        // if($birthmonth && (!is_int($birthmonth) || $birthmonth < 1 || $birthmonth > 12)){
        //   $user_errors->add( 'birthmonth',__('Birth Month must be a number between 1 & 31','itstar'),$birthmonth );
        //   var_dump(is_int($birthmonth));

        // }
        // if($birthyear && !is_int($birthyear)){
        //   $user_errors->add( 'birthyear',__('Birth Year must be Number','itstar'),$birthyear );
        //  var_dump(is_int($birthyear));

        // }
        // if($phone && !is_int($phone)){
        //   $user_errors->add( 'phone',__('Phone must be a Number','itstar'),$phone );
        //    var_dump(is_int($phone));
        // }

        if($aspam == $aspam_result){
            if ( !username_exists( $user )  && !email_exists( $email ) && 1 > count($user_errors->get_error_messages()) ) {

                $user_id = wp_create_user( $user, $pass, $email );

                if( !is_wp_error($user_id) ) {
                    //user has been created
                    $user = new WP_User( $user_id );
                    $user->set_role( 'subscriber' );



                    update_user_meta( $user_id, 'first_name', $fname );
                    update_user_meta( $user_id, 'last_name', $lname );
                    update_user_meta( $user_id, 'birthday', $birthday );
                    update_user_meta( $user_id, 'birthmonth', $birthmonth );
                    update_user_meta( $user_id, 'birthyear', $birthyear );
                    update_user_meta( $user_id, 'phone', $phone );
                    update_user_meta( $user_id, 'job', $job );

                    if(current_user_can('edit_posts')){
                        $firstid = 1999;
                    }else{
                        $firstid = 2999;
                    }
                    $latestid=$wpdb->get_var("SELECT meta_value from $wpdb->usermeta where meta_key='viraclub' order by meta_value DESC limit 1;");
                    $latestid = ($latestid)?($latestid):($firstid);
                    update_user_meta( $user_id, 'viraclub', $latestid+1 );
                    //Redirect
                    //wp_redirect( 'URL_where_you_want_redirect' );
                    //exit;


                    itstar_send_registration_admin_email($user_id);
                    itstar_user_registration_welcome_email($user_id);

                    log_me_the_f_in( $user_id );
                } else {

                    var_dump($user_id->get_error_message());
                }
            } else {
                $user_errors->add( 'userexists',__('Another user have been registered by this User Name or Email','itstar') );

            }
        } else {
            $user_errors->add( 'aspam',__('Anti Spam is Not correct!','itstar') );
        }

    } elseif($submited == "true") {
        $user_errors->add( 'requiredfields',__('Please fill the required fields : User Name - Email - Password','itstar') );
    }


}
//add_action('init','itstar_create_account');


// registration and login form shortcode
function itstar_user_register( $atts, $content = null ) {
    $a = shortcode_atts( array(
        'attr_1' => 'attribute 1 default',
        'attr_2' => 'attribute 2 default',
        // ...etc
    ), $atts );

    global $user_errors;

    $form_display = "";
    if(count($user_errors->get_error_messages())>0){
        $form_display = "form-display";
    }

    $required = $user_errors->get_error_messages('requiredfields');
    $required = (!empty($required))?$required:array('');

    $spam_error = $user_errors->get_error_messages('aspam');
    $spam_error = (!empty($spam_error))?$spam_error:array('');

    $userexists = $user_errors->get_error_messages('userexists');
    $userexists = (!empty($userexists))?$userexists:array('');
    // $birthday = $user_errors->get_error_messages('birthday');
    //     $birthday = (!empty($birthday))?$birthday:array('');
    // $birthmonth = $user_errors->get_error_messages('birthmonth');
    //     $birthmonth = (!empty($birthmonth))?$birthmonth:array('');
    // $birthyear = $user_errors->get_error_messages('birthyear');
    //     $birthyear = (!empty($birthyear))?$birthyear:array('');
    $phone = $user_errors->get_error_messages('birthyearphone');
    $phone = (!empty($phone))?$phone:array('');

    $anti_no1 = rand(3,12);
    $anti_no2 = rand(4,16);
    $anti_spam = $anti_no1+$anti_no2;


    $register_form = '';
    $register_form .= '<div class="forms_buttons"><a href="#" id="register-show" class="register-show">'.__('Vira Club Registeration','itstar').'</a>';
    $register_form .= '<a href="#" id="login-show" class="login-show">'.__('Login to Site','itstar').'</a></div>';
    $register_form .= '<div class="register-container '.$form_display.' ">';
    $register_form .= '<label class="form_error">'.$required[0].'</label>';
    $register_form .= '<label class="form_error">'.$spam_error[0].'</label>';
    $register_form .= '<label class="form_error">'.$userexists[0].'</label>';
    $register_form .= '<form method="post" class="register_form" name="registerForm">';
    $register_form .='<table>';
    $register_form .= '<tr><th>'.__('First Name','itstar').'</th><td>'.'<input id="fname" type="text"  name="fname" />'.'</td></tr>';
    $register_form .='<tr><th>'. __('Last Name','itstar').'</th><td>'. '<input id="lname" type="text" name="lname" />'.'</td></tr>';
    $register_form .= '<tr><th>'.__('UserName','itstar').'</th><td>'. '<input id="uname" type="text" name="uname" />'.'</td></tr>';
    $register_form .= '<tr><th>'.__('Birthday','itstar').'</th><td>'. '<input id="birthday" type="number" name="birthday" min="1" max="31"/>'.'</td></tr>';

    $register_form .= '<tr><th>'.__('Birth Month','itstar').'</th><td>'. '<input id="birthmonth" type="number" name="birthmonth" min="1" max="12"/>'.'</td></tr>';

    $register_form .='<tr><th>'. __('Birth Year','itstar').'</th><td>'. '<input id="birthyear" type="number" name="birthyear" min="1300"/>'.'</td></tr>';

    $register_form .= '<tr><th>'.__('Job','itstar').'</th><td>'. '<input id="job" type="text" name="job" />'.'</td></tr>';
    $register_form .= '<tr><th>'.__('Phone','itstar').'</th><td>'. '<input id="phone" type="number" min="1111"  name="phone" />'.'</td></tr>';

    $register_form .= '<tr><th>'.__('Email','itstar').'</th><td>'. '<input id="email" type="text" name="uemail" />'.'</td></tr>';
    $register_form .= '<tr><th>'.__('Password','itstar').'</th><td>'.'<input type="password" pattern=".{6,}"  name="upass" />'.'</td></tr>';
    $register_form .= '<tr><th></th><td><small>'.__('At least 6 character.','itstar').'</small></td></tr>';
    $register_form .= '<tr><th>Anti Spam</th><td>'.$anti_no1 .' + '. $anti_no2.' = '.'<input id="anti_spam" type="number" min="1" max="40" name="aspam" />'.'<input value="'.$anti_spam.'" type="hidden"  name="aspam_result" />'.'</td></tr>';
    $register_form .= '<tr><input value="true" type="hidden"  name="submited" /></tr>';
    $register_form .= '<tr><td>'.'<input type="submit" value="'.__('Submit','itstar').'" />'.'</td></tr>';
    $register_form .= '</table>';
    $register_form .= '</form>';
    $register_form .= '</div>';
    if ( !is_user_logged_in() ) {
        return $register_form;
    }
}
//add_shortcode( 'vira_register', 'itstar_user_register' );

//user login shortcode
function itstar_user_login(){
    $args = array('echo'=>false);
    if ( !is_user_logged_in() ) {
        return '<div class="login-container">'.wp_login_form( $args ).'</div>';
    }
}
//add_shortcode( 'vira_login', 'itstar_user_login' );


// user profile shortcode
function itstar_user_profile( $atts, $content = null ) {
    // $a = shortcode_atts( array(
    //     'attr_1' => 'attribute 1 default',
    //     'attr_2' => 'attribute 2 default',
    //     // ...etc
    // ), $atts );
    $user_profile = "";
    if ( is_user_logged_in() ) {
        $current_user = wp_get_current_user();
        /**
         * @example Safe usage: $current_user = wp_get_current_user();
         * if ( !($current_user instanceof WP_User) )
         *     return;
         */
        $user_profile .= '<div  class="article-title"><h3>'.__('User Profile','itstar').'</h3></div>';
        $user_profile .=  '<div class="avatar-container">'.get_avatar($current_user->ID).'</div>';
        $user_profile .=  '<div class="profile-container">';

        $user_profile .= '<strong>'.__('first name: ','itstar') .'</strong>'. $current_user->user_firstname . '<br />';
        $user_profile .= '<strong>'.__('last name: ','itstar') .'</strong>'. $current_user->user_lastname . '<br />';
        $user_profile .= '<strong>'.__('Username: ','itstar') .'</strong>'. $current_user->user_login . '<br />';

        $user_profile .= '<strong>'.__('Birthday: ','itstar') .'</strong>'.get_user_meta($current_user->ID , 'birthday',true).' - '.get_user_meta($current_user->ID , 'birthmonth',true) .' - '.get_user_meta($current_user->ID , 'birthyear',true). '<br />';
        $user_profile .= '<strong>'.__('Phone: ','itstar') .'</strong>'.get_user_meta($current_user->ID , 'phone',true) . '<br />';
        $user_profile .= '<strong>'.__('Email: ','itstar') .'</strong>'. $current_user->user_email . '<br />';
        $user_profile .= '<strong>'.__('Job: ','itstar') .'</strong>'.get_user_meta($current_user->ID , 'job',true) . '<br />';
        if(!current_user_can('edit_posts')){
            $user_profile .= '<strong>'.__('Vira Club ID: ','itstar') .'</strong>'.'<span class="viraid">V'.get_user_meta($current_user->ID , 'viraclub',true) . '</span><br />';

        }
        $user_profile .= '<br />'.'<a class="vira_logout" href="'.wp_logout_url( get_permalink() ).'">'.__('Logout','itstar').'</a>';
        $user_profile .=  '</div>';




    }

    return $user_profile;
}
//add_shortcode( 'vira_profile', 'itstar_user_profile' );

function itstar_projects_in_cat( $atts, $content = null ) {
    global $wp_query;
    $a = shortcode_atts( array(
        'cat' => '',
        'qty' => -1,
        // ...etc
    ), $atts );

    $projects = get_posts(array(
            'post_type' => 'project',
            'posts_per_page' => $a['qty'],
            'project_cat'         => $a['cat'],
        )
    );


    if(!empty($projects)){ ?>

        <ul class="projects-list">
            <li><span><?php echo __('Title','itstar'); ?></span></li>
            <?php foreach($projects as $project){
                setup_postdata( $project ) ;
                $project_date = get_post_meta($project->ID,'_itstar_project_date',1);?>

                <li class="project-link">
                    <a href="<?php echo get_the_permalink($project->ID); ?>">
                        <span><?php echo esc_html($project_date).' - '; ?></span>
                        <span><?php echo $project->post_title; ?></span>
                    </a>

                </li>
            <?php } ?>
        </ul>
    <?php }
    wp_reset_postdata();
}
//add_shortcode( 'projects', 'itstar_projects_in_cat' );


/*-----------Vira Products in Cat-------------------------------*/
function itstar_products_in_cat( $atts, $content = null ) {
    global $wp_query;
    $a = shortcode_atts( array(
        'cat' => '',
        'title' => '',
        'qty' => -1,
        // ...etc
    ), $atts );

    $products = get_posts(array(
            'post_type' => 'product',
            'posts_per_page' => $a['qty'],
            'product_cat'         => $a['cat'],
        )
    ); ?>

    <section class="layout">
        <div class="single-cat-title">
            <h2><?php echo $a['title'] ?></h2>
        </div>
    </section>
    <?php if(!empty($products)){ ?>


        <section class="layout">
            <?php foreach($products as $product){
                setup_postdata( $product ) ; ?>

                <article class="hentry">

                    <header class="article-title">
                        <a href="<?php echo get_post_permalink($product->ID); ?>">
                            <h3><?php echo $product->post_title; ?></h3>
                        </a>
                    </header>
                    <div class="featured-image single-image">
                        <a href="<?php echo get_post_permalink($product->ID); ?>">
                            <?php echo get_the_post_thumbnail($product->ID); ?>
                        </a>
                    </div>

                    <main class="article-body">

                        <?php
                        global $post;
                        $save_post = $post;
                        $post = get_post($product->ID);
                        $excerpt = get_the_excerpt();
                        echo $excerpt;
                        $post = $save_post;

                        ?>

                    </main>
                </article>
            <?php } ?>
        </section>
    <?php }
    wp_reset_postdata();
}
//add_shortcode( 'products', 'itstar_products_in_cat' );
//--------------------- user extra fields ----------------------
//add_action( 'show_user_profile', 'itstar_extra_user_profile_fields' );
//add_action( 'edit_user_profile', 'itstar_extra_user_profile_fields' );
function itstar_extra_user_profile_fields( $user ) {
    ?>
    <h3><?php _e("Extra profile information", "itstar"); ?></h3>
    <table class="form-table">
        <tr>
            <th><label for="birthday"><?php echo __("birthday",'itstar'); ?></label></th>
            <td>
                <input type="text" name="birthday" id="Birth Day" class="regular-text"
                       value="<?php echo esc_attr( get_user_meta( $user->ID,'birthday' ,true) ); ?>" /><br />
                <span class="description"><?php echo __("Please enter your Birthday.","itstar"); ?></span>
            </td>
        </tr>
        <tr>
            <th><label for="birthmonth"><?php echo __("Birth Month",'itstar'); ?></label></th>
            <td>
                <input type="text" name="birthmonth" id="birthmonth" class="regular-text"
                       value="<?php echo esc_attr( get_user_meta( $user->ID,'birthmonth' ,true) ); ?>" /><br />
                <span class="description"><?php echo __("Please enter your Birth Month.","itstar"); ?></span>
            </td>
        </tr>
        <tr>
            <th><label for="birthyear"><?php echo __("Birth Year",'itstar'); ?></label></th>
            <td>
                <input type="text" name="birthyear" id="birthyear" class="regular-text"
                       value="<?php echo esc_attr( get_user_meta( $user->ID,'birthyear' ,true) ); ?>" /><br />
                <span class="description"><?php echo __("Please enter your Birth Year.","itstar"); ?></span>
            </td>
        </tr>
        <tr>
            <th><label for="phone"><?php echo __("Phone",'itstar'); ?></label></th>
            <td>
                <input type="text" name="phone" id="phone" class="regular-text"
                       value="<?php echo esc_attr( get_user_meta(  $user->ID ,'phone',true) ); ?>" /><br />
                <span class="description"><?php echo __("Please enter your phone.","itstar"); ?></span>
            </td>
        </tr>
        <tr>
            <th><label for="job"><?php echo __("Job",'itstar'); ?></label></th>
            <td>
                <input type="text" name="job" id="job" class="regular-text"
                       value="<?php echo esc_attr( get_user_meta( $user->ID ,'job',true) ); ?>" /><br />
                <span class="description"><?php echo __("Please enter your Job.","itstar"); ?></span>
            </td>
        </tr>
        <tr>
            <th><label for="viraclub"><?php __("Vira club ID",'itstar'); ?></label></th>
            <td>
                <input type="text" disabled name="viraclub" id="viraclub" class="regular-text"
                       value="<?php echo 'V'.esc_attr( get_user_meta( $user->ID,'viraclub' ,true) ); ?>" /><br />

            </td>
        </tr>
    </table>
    <?php
}

//add_action( 'personal_options_update', 'itstar_save_extra_user_profile_fields' );
//add_action( 'edit_user_profile_update', 'itstar_save_extra_user_profile_fields' );
function itstar_save_extra_user_profile_fields( $user_id ) {
    $saved = false;
    if ( current_user_can( 'edit_user', $user_id ) ) {
        update_user_meta( $user_id, 'birthday', $_POST['birthday'] );
        update_user_meta( $user_id, 'birthmonth', $_POST['birthmonth'] );
        update_user_meta( $user_id, 'birthyear', $_POST['birthyear'] );
        update_user_meta( $user_id, 'phone', $_POST['phone'] );
        update_user_meta( $user_id, 'job', $_POST['job'] );
        $saved = true;
    }
    return true;
}


// auto login user after registration
function log_me_the_f_in( $user_id ) {
    $user = get_user_by('id',$user_id);
    $username = $user->user_nicename;
    $user_id = $user->ID;
    wp_set_current_user($user_id, $username);
    wp_set_auth_cookie($user_id);
    do_action('wp_login', $username, $user);
}


function itstar_send_registration_admin_email($user_id){
    // $hash = md5( $random_number );
    // add_user_meta( $user_id, 'hash', $hash );



    $message = '';
    $user_info = get_userdata($user_id);
    $to = get_option('admin_email');
    $un = $user_info->display_name;
    $pw = $user_info->user_pass;
    $viraclub_id = get_user_meta( $user_id, 'viraclub', 1);

    $subject = __('New User Have Registered ','itstar').get_option('blogname');

    $message .= __('Username: ','itstar').$un;
    $message .= "\n";
    $message .= __('Password: ','itstar').$pw;
    $message .= "\n\n";
    $message .= __('ViraClub ID: ','itstar').'V'.$viraclub_id;


    //$message .= 'Please click this link to activate your account:';
    // $message .= home_url('/').'activate?id='.$un.'&key='.$hash;
    $headers = 'From: <info@itstar.com>' . "\r\n";
    wp_mail($to, $subject, $message);
}
//add_action( 'user_register', 'itstar_send_registration_admin_email' );


function itstar_user_registration_welcome_email($user_id){
    // $hash = md5( $random_number );
    // add_user_meta( $user_id, 'hash', $hash );

    $admin_email = get_option('admin_email');

    $user_info = get_userdata($user_id);
    $to = $user_info->user_email;
    $un = $user_info->display_name;
    $pw = $user_info->user_pass;
    $viraclub_id = get_user_meta( $user_id, 'viraclub', 1);

    $subject = __('Welcome to ','itstar').get_option('blogname');
    $message = __('Hello,','itstar').$un;
    $message .= "\n\n";
    $message .= __('Welcome to Our Site','itstar');
    $message .= "\n\n";
    $message .= __('Username: ','itstar').$un;
    $message .= "\n";
    $message .= __('Password: ','itstar').$pw;
    $message .= "\n\n";
    $message .= __('ViraClub ID: ','itstar').'V'.$viraclub_id;
    //$message .= 'Please click this link to activate your account:';
    // $message .= home_url('/').'activate?id='.$un.'&key='.$hash;
    $headers = 'From: <info@itstar.com>'."\r\n";
    wp_mail($to, $subject, $message);
}
//add_action( 'user_register', 'itstar_user_registration_welcome_email' );


//add columns to User panel list page
function Viradeco_add_user_columns($column) {
    $column['viraclub'] = __('ViraClub ID','itstar');
    $column['phone'] = __('Phone','itstar');
    $column['email'] = __('Email','itstar');

    return $column;
}
//add_filter( 'manage_users_columns', 'itstar_add_user_columns' );

//add the data
function itstar_add_user_column_data( $val, $column_name, $user_id ) {


    switch ($column_name) {
        case 'viraclub' :
            return 'V'.get_user_meta($user_id,'viraclub',true);
            break;
        case 'phone' :
            return get_user_meta($user_id,'phone',true);
            break;
        case 'email' :
            return get_user_meta($user_id,'uemail',true);
            break;
        default:
    }
    return;
}
//add_filter( 'manage_users_custom_column', 'itstar_add_user_column_data', 10, 3 );

function itstar_viraclub_id($user_id){
    global $wpdb;

    $user = new WP_User( $user_id );

    // Set your role

    $firstid = 2999;


    $latestid=$wpdb->get_var("SELECT meta_value from $wpdb->usermeta where meta_key='viraclub' order by meta_value DESC limit 1;");
    $latestid = ($latestid)?($latestid):($firstid);
    update_user_meta( $user_id, 'first_name', $latestid+1 );

    // Destroy user object
    unset( $user );
}

//add_action( 'user_register', 'itstar_viraclub_id' );
function vira_login_redirect( $redirect_to, $request, $user ) {
    //is there a user to check?
    global $user;
    if ( isset( $user->roles ) && is_array( $user->roles ) ) {
        //check for admins
        if ( in_array( 'administrator', $user->roles ) ) {
            // redirect them to the default place
            return $redirect_to;
        } else {
            return home_url();
        }
    } else {
        return $redirect_to;
    }
}

//add_filter( 'login_redirect', 'vira_login_redirect', 10, 3 );


function itstar_user_only( $atts, $content = null ){
    if( null != $content && current_user_can('read') ){
        return $content;
    } else {
        $mylink = get_permalink();
        return '<p>'.__(' -- Only registered Users can Download the Catalog -- ','itstar').'</p>';
    }
}
//add_shortcode('onlyusers', 'itstar_user_only');
?>