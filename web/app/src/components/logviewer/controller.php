<?php
class logviewerController {
    /**
     * @var logviewerModel;
     */
    private $model = null;

    /**
     * @var Request;
     */
    private $request = null;

    public function __construct($objects) {
        if (isset($objects['model'])) {
            $this->model = $objects['model'];
        }
        if (isset($objects['request'])) {
            $this->request = $objects['request'];
        }
    }

    public function index()
    {
        $data = [];
        //вынести в отдельные методы
        $start = (isset($this->request->get['start']) and (intval($this->request->get['start']) > 0)) ? $this->request->get['start'] : 0;
        $limit = (isset($this->request->get['limit']) and (intval($this->request->get['limit']) > 0)) ? $this->request->get['limit'] : 100;
        $order = (isset($this->request->get['order']) and in_array($this->request->get['order'], $this->model->getColumns())) ? $this->request->get['order'] : 'ts';
        $orderby = (isset($this->request->get['orderby']) and in_array($this->request->get['orderby'], ['DESC', 'ASC'])) ? $this->request->get['orderby'] : 'DESC';
        $filters = (isset($this->request->get['filters']) AND is_array($this->request->get['filters'])) ? $this->request->get['filters'] : [];

        foreach ($filters as $key => $val) {
            if (!in_array($key , $this->model->getColumns())) {
                unset($filters[$key]);
            }
        }

        $data['start'] = $start;
        $data['limit'] = $limit;
        $data['order'] = $order;
        $data['orderby'] = $orderby;
        $data['filters'] = $filters;
        $data['count'] = $this->model->getCount($data);
        $data['types'] = $this->model->getTypes();

        $rows = $this->model->getData($data);
        $data['rows'] = $rows;
        //Завести объект response
        template::render(__DIR__ . '/list.php', $data);
   }
   public function form() {
        $data = [];
        $data['ts'] = date('Y-m-d H:i:s');
        if ($this->request->post) {
            $data['ts'] = $this->request->post['ts'];
            $data['type'] = $this->request->post['type'];
            $data['message'] = $this->request->post['message'];
            if ($this->validate($data)) {
                if ($this->model->save($data)) {
                   template::render(__DIR__ . '/success.php' , $data);
                }
            }
        } else {
            template::render(__DIR__ . '/form.php' , $data);
        }
   }
   private function validate($data) {
        //TODO сделать проверку данных
        return true;
   }
}