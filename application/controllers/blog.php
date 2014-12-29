<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends CI_Controller {

	private $categories;

	public function __construct()
	{
		parent::__construct();

		$this->load->model('blog_model');

		$categories = $this->blog_model->get_categories();
		foreach($categories as $C)
			$this->categories[$C->Slug] = $C->Title;
	}

	// all or just a category
	public function index($category = NULL)
	{
		// wrong category
		if(!empty($category) && !array_key_exists($category, $this->categories))
			show_404();

		// some things
		$pageTitle = empty($category) ? 'Yann Landry' : $this->categories[$category];
		$postsHTML = $this->get_posts($category, 0, true);

		// showin off
		$this->load->view('header', array('pageTitle' => $pageTitle, 'categories' => $this->categories, 'category' => $category));
		$this->load->view('category', array('postsHTML' => $postsHTML, 'category' => $category));
		$this->load->view('footer');
	}

	// API function to get posts
	public function get_posts($category = NULL, $before = 0, $return = false)
	{
		$posts = $this->blog_model->get_posts($category, $before);

		// render html
		$visuals = $this->load->view('posts', array('posts' => $posts), true);

		// return or print
		if($return)
			return $visuals;
		else
			echo $visuals;
		return ;
	}

	public function post($slug)
	{
		// get get get
		$P = $this->blog_model->get_post($slug);
		if($P == false) show_404();

		// some things
		$pageTitle = $P->Title;

		// showin off
		$this->load->view('header', array('pageTitle' => $pageTitle, 'categories' => $this->categories, 'category' => $P->CategorySlug));
		$this->load->view('post', array('P' => $P));
		$this->load->view('footer');
	}

}

/* End of file blog.php */
/* Location: ./application/controllers/blog.php */