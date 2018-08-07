<?php
namespace App\Libraries;

class AppView
{
    /**
     * Initialization hook method.
     */
    public function __construct()
    {
        //$prefix = !empty($this->request->params['prefix']) ? $this->request->params['prefix'] . '_' : '';
        //$page = $prefix.$this->request->params['controller'].'_'.$this->request->params['action'];
        $tableId = '';
        $ajax['url'] = '';
        $columns = [];
        $order = [];
        $searchParamsID = [];
        $page=11;
        if ($page == 11){
            $tableId = 'ProductTable';
            $ajax['url'] = '/products';
            $columns = ['id', 'title', 'user_id', 'created', 'agency_id','status', 'action'];
            $searchParamsID = ['id','title','user_id','created','agency_id','status','m_datepicker_1','agency_type','selectUser'];
            $order = '[[3,"DESC"]]';

        }
        $searching = 'false';
        $ordering = 'true';
         //order by specific column. column serial starts from 0
        $pageLength = 10;
        // $lengthMenu = '[[10, 20, 25, 50, -1], [10, 20, 25, 50, "All"]]';
        $lengthMenu = '[[10, 20, 25, 50, -1], [10, 20, 25, 50, "All"]]';
        $lengthChange = 'false';
        $filter = '';
        $processing = 'true';
        $language = '{"processing":"loading.. <img src=\"/admin/img/loading-spinner-default.gif\">"}';
        // $columnSearch = [0,1,2];
        // $theadIdCoulmnSearch = 'searchColumn';

        $config = array('tableId' => $tableId, 'ajax' => $ajax, 'columns' => $columns, 'searching' => $searching, 'ordering' => $ordering, 'order' => $order,'pageLength' => $pageLength,'lengthMenu' => $lengthMenu,'filter' => $filter,'processing' => $processing,'language' => $language,'searchParamsID' => $searchParamsID,'lengthChange' => $lengthChange);
        //$this->loadHelper('Datatable', $config);
    }
}
