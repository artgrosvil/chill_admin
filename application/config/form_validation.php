<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
	'users_auth/send_email' => array(
		array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'trim|required|xss_clean'
			)
		),
	'users_auth/send_code' => array(
		array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'trim|required|xss_clean'
			),
		array(
			'field' => 'code',
			'label' => 'Code',
			'rules' => 'trim|required|xss_clean'
			)
		),
	'users_admin/add' => array(
		array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'trim|xss_clean'
			)
		),
	'users_admin/edit' => array(
		array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'trim|required|xss_clean'
			)
		),
	'users_app/add' => array(
		array(
			'field' => 'login',
			'label' => 'Login',
			'rules' => 'trim|required|xss_clean'
			),
		array(
			'field' => 'name',
			'label' => 'Name',
			'rules' => 'trim|xss_clean'
			),
		array(
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'trim|required|xss_clean'
			),
		array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'trim|xss_clean'
			)
		),
	'users_app/edit' => array(
		array(
			'field' => 'id',
			'label' => 'Login',
			'rules' => 'trim|required|xss_clean'
			),
		array(
			'field' => 'login',
			'label' => 'Login',
			'rules' => 'trim|required|xss_clean'
			),
		array(
			'field' => 'name',
			'label' => 'Name',
			'rules' => 'trim|xss_clean'
			),
		array(
			'field' => 'email',
			'label' => 'Password',
			'rules' => 'trim|xss_clean'
			),
		array(
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'trim|required|xss_clean'
			)
		)
	);