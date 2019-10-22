<?php
namespace Magenest\Movie\Block;
use Magento\Framework\View\Element\Template;

class MovieList1 extends \Magento\Framework\View\Element\Template
{
    private $_movie;
    private $_resource;
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magenest\Movie\Model\MovieActor $_movie,
        \Magento\Framework\App\ResourceConnection $resource,
        array $data = []
    ) {
        $this->_movie = $_movie;
        $this->_resource = $resource;

        parent::__construct(
            $context,
            $data
        );
    }

    public function getMovies1()
    {
        $collection = $this->_movie->getCollection();
        $second_table_name = $this->_resource->getTableName('magenest_movie');
        $third_table_name = $this->_resource->getTableName('magenest_actor');
        $fourth_table_name = $this->_resource->getTableName('magenest_director');
        $select = $collection->getSelect();
        $select->join(array('second' => $second_table_name),
            'main_table.movie_id = second.movie_id',array('movie_name'=>'second.name',"description"=>'second.description','rating'=>'second.rating'));
        $select->join(array('third' => $third_table_name),
            'main_table.actor_id = third.actor_id',array('actor_name'=>new \Zend_Db_Expr('group_concat(`third`.name SEPARATOR ",")')));
        $select->join(array('four' => $fourth_table_name),
            'second.director_id = four.director_id',array('director_name'=>'four.name'));
        $select->group('second.movie_id');
        //echo $collection->getSelect()->__toString();
        return $collection;
    }
}