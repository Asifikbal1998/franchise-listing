<?php
function pas_digital_customizer_register($wp_customize){
  
  // add logo image
  $wp_customize -> add_section('pas-digital_header_area',array(
    'title' =>__( 'Header Area','pas-digital' ),
    'description' => 'If You interested to upload your header area, You can to it here.'
  ));

  $wp_customize -> add_setting('pas-digital_logo',array(
    'default'=> get_bloginfo( 'pas-digital_directory').'/image/logo png.png',
  ));

  $wp_customize -> add_control( new Wp_Customize_Image_Control($wp_customize,'pas-digital_logo',array(
    'label' => 'logo upload',
    'description'=>'If You interested to upload your header area, You can to it here.',
    'seeting' => 'pas-digital_logo',
    'section' => 'pas-digital_header_area',
  )));

  //footer area
  $wp_customize -> add_section('pas-digital_footer_option',array(
    'title' =>__( 'Footer Option','pas-digital' ),
    'description' => 'If You interested to change or update your footer seetings, You can do it.'
  ));

  $wp_customize -> add_setting('pas-digital_copyright_section',array(
    'default'=> '&copy; Copy Right 2022 | pas-digital Md',
  ));

  $wp_customize -> add_control( 'pas-digital_copyright_section',array(
    'label' => 'Copy Right Text',
    'description'=>'If need you can update your copyright text from here.',
    'seeting' => 'pas-digital_copyright_section',
    'section' => 'pas-digital_footer_option',
  ));


}
add_action( 'customize_register','pas_digital_customizer_register' );