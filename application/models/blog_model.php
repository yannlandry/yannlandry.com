<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog_model extends CI_Model {

	public function get_categories()
	{
		return $this->db->query("SELECT Slug, Title FROM categories ORDER BY Position ASC")->result();
	}

	public function get_posts($category, $before)
	{
		$before = intval($before);
		$category = $this->db->escape_str(trim($category));

		$whereArgs = array();

		if($before)
			$whereArgs[] = "P.ID < $before";
		if(!empty($category))
			$whereArgs[] = "P.CategorySlug = '$category'";

		$whereString = !empty($whereArgs) ? ("WHERE " . implode(" AND ", $whereArgs)) : NULL;

		$query = "
			SELECT P.ID, P.Slug, P.CategorySlug, P.Title, P.Abstract, P.Creation, C.Title AS CategoryTitle
			FROM posts AS P INNER JOIN categories AS C ON C.Slug = P.CategorySlug
			$whereString ORDER BY P.ID DESC LIMIT 0,10
		";

		return $this->db->query($query)->result();
	}

	public function get_post($slug)
	{
		$Q = $this->db->query("SELECT CategorySlug, Title, Content, Creation FROM posts WHERE Slug = ? LIMIT 1", array($slug));

		if($Q->num_rows() == 0) return false;
		else return $Q->row();
	}

}

/* End of file blog_model.php */
/* Location: ./application/models/blog_model.php */