<?php

namespace App\Libraries;

class DatatableHelper
{

    // public $helpers = ['Html'];
    // public $tableId = 'm_datatable';
    // public $method = 'GET';
    // public $url = '';
    // public $pageSize = 10;
    // public $sortable = true;

    // public $pagination = true;
    // public $serverPaging = true;
    // public $serverFiltering = true;
    // public $serverSorting = true;
    // public $scroll = false;
    // public $footer = false;
    // public $seachField = '#generalSearch';
    public $tableId = 'idoftable'; ///must
    public $serverSide = 'true'; ///must
    public $destroy = 'true'; ///must
    public $searching = '';
    public $ordering = '';
    public $order = '';
    public $pageLength = '';
    public $lengthMenu = '';
    public $filter = ''; //globarl search option true false
    public $processing = '';
    public $language ='';
    public $columnSearch = '';
    public $theadIdCoulmnSearch = '';
    public $searchParamsID = '';
    public $lengthChange ='';


    public $ajax = [];
    public $columns = [];

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

            $tableId = 'Product';
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
        $this->initialize($config);
    }

    public function initialize(array $config)
    {
        // parent::initialize();
        /////// FOR NORMAL CONFIG
        if (!empty($config['tableId'])) : $this->tableId = $config['tableId'];endif;
        if (!empty($config['serverSide'])) : $this->serverSide = $config['serverSide'];endif;
        if (!empty($config['destroy'])) : $this->destroy = $config['destroy'];endif;
        if (!empty($config['searching'])) : $this->searching = $config['searching'];endif;
        if (!empty($config['ordering'])) : $this->ordering = $config['ordering'];endif;
        if (!empty($config['order'])) : $this->order = $config['order'];endif;
        if (!empty($config['pageLength'])) : $this->pageLength = $config['pageLength'];endif;
        if (!empty($config['lengthMenu'])) : $this->lengthMenu = $config['lengthMenu'];endif;
        if (!empty($config['filter'])) : $this->filter = $config['filter'];endif;
        if (!empty($config['processing'])) : $this->processing = $config['processing'];endif;
        if (!empty($config['language'])) : $this->language = $config['language'];endif;
        if (!empty($config['searchParamsID'])) : $this->searchParamsID = $config['searchParamsID'];endif;
        if (!empty($config['lengthChange'])) : $this->lengthChange = $config['lengthChange'];endif;
        // if (!empty($config['columnSearch']) && !empty($config['theadIdCoulmnSearch'])) : 
        //     $this->columnSearch = $config['columnSearch'];
        //     $this->theadIdCoulmnSearch = $config['theadIdCoulmnSearch'];
        // endif;

        ////////////////

        ////////// FOR AJAX PART CONFIG
        if (!empty($config['ajax']['url'])) : $this->ajax['url'] = $config['ajax']['url'];endif;
        /////////////

        if (!empty($config['columns'])) : $this->columns = $config['columns'];endif;

        $this->load();
    }

    public function load()
    {
        $js = '<script>function getData(){';
        $searchJs ='';

        /////// FOR NORMAL CONFIG

        if (!empty($this->tableId)): $js .= 'var table= $("#' . $this->tableId . '").DataTable( {';endif;
        if (!empty($this->serverSide)): $js .= '"serverSide": ' . $this->serverSide . ','; endif;
        if (!empty($this->destroy)): $js .= '"destroy": ' . $this->destroy . ','; endif;
        if (!empty($this->searching)): $js .= '"searching": ' . $this->searching . ','; endif;
        if (!empty($this->ordering)): $js .= '"ordering": ' . $this->ordering . ','; endif;
        if (!empty($this->order)): $js .= '"order": ' . $this->order . ','; endif;
        if (!empty($this->pageLength)): $js .= '"pageLength": ' . $this->pageLength . ','; endif;
        if (!empty($this->lengthMenu)): $js .= '"lengthMenu": ' . $this->lengthMenu . ','; endif;
        if (!empty($this->filter)): $js .= '"filter": ' . $this->filter . ','; endif;
        if (!empty($this->processing)): $js .= '"processing": ' . $this->processing . ','; endif;
        if (!empty($this->language)): $js .= '"language": ' . $this->language . ','; endif;
        if (!empty($this->lengthChange)): $js .= '"lengthChange": ' . $this->lengthChange . ','; endif;
        // if (!empty($this->columnSearch) && !empty($this->theadIdCoulmnSearch) ): 
        //     $searchJs = $this->getColumnSearch($this->tableId,$this->columnSearch,$this->theadIdCoulmnSearch);
        // endif;
        if (!empty($this->searchParamsID)): 
            $searchJs .= $this->getParamsSearch($this->searchParamsID);
            // dd($searchJs);
        endif;

        ////////////////

        ////////// FOR AJAX PART CONFIG
        if (!empty($this->ajax['url'])): $js .= '"ajax": {"url": "' . $this->ajax['url'] . '",'; endif;
        $js .= $searchJs;
        $js .= '},';

        $js .= $this->columns($this->columns);
        $js .= '});}';
        // $js .= $searchJs;
        $js .= '</script>';
        return $js;


    }

    function columns($columns){
        $jsStr=  '';
        if (!empty($columns)) {
            $jsStr .= '"columns": [';
            foreach ($columns as $column) {
                $jsStr .= '{ "data": "' . $column . '" },';
            }
            $jsStr .= ']';
        }
        return $jsStr;

    }

    // function getColumnSearch($tableId,$columnSearch,$theadIdCoulmnSearch){
    //     $jsStr=  '';
    //     $i =0;
    //     $columnList ='';
    //     foreach ($columnSearch as $column) {
    //         if($i!=0): $columnList .=',';endif;
    //         $columnList .= ":eq(".$column.")";
    //         $i++;
    //     }
    //     $jsStr .= '$(\'#'.$tableId.' #'.$theadIdCoulmnSearch.' th\').filter(\''.$columnList.'\').each( function () {
    //                         var title = $(\'#'.$tableId.' #'.$theadIdCoulmnSearch.' th\').eq( $(this).index() ).text();
    //                         $(this).html( \'<input type=\"text\" placeholder=\"Search \'+title+\'\" id =\"filter\'+$(this).index()+\'\"/>\' );
    //                     } );';

    //     $jsStr .='$(\'#'.$tableId.' #'.$theadIdCoulmnSearch.' input\').on( \'keyup change\', function () {
    //                     table
    //                         .column( $(this).parent().index()+\':visible\' )
    //                         .search( this.value )
    //                         .draw();
    //                 } );';
    //     return $jsStr;

    // }


    function getParamsSearch($searchParamsID){
        $jsStr = '"data": function ( d ) {';
        foreach ($searchParamsID as $id) {
            $jsStr .='d.'.$id.' = $(\'#'.$id.'\').val();';
        }
        $jsStr .= '}';
        return $jsStr;
    }
}
