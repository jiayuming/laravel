<?php


    function getMenus(){
        $menus=\App\Model\Tree::createNodeMenusTree(\App\Model\Menus::all());
        $returnHtml="<ul class=\"nav column-menu black-bg\">";
        foreach ($menus as $menu){
            if($menu->child){
                $returnHtml.='<li class="dropdown">';
                $returnHtml.='<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'. $menu->name .'<span class="caret"></span></a>';
                $returnHtml.= getChildMenus($menu->child);
                $returnHtml.= '</li>';
            }else{
                $returnHtml.="<li><a href=''>". $menu->name ."</a></li>";
            }
        }
        $returnHtml.="</ul>";
        return $returnHtml;
    }

    function getChildMenus($childMenus){
        $returnHtml='<ul class="dropdown-menu">';
        foreach ($childMenus as $childMenu){
            $returnHtml.='<li><a href="">'. $childMenu->name .'</a></li>';
        }
        $returnHtml.="</ul>";

        return $returnHtml;
    }


    function getPages($ids,$numbers){
        $list=\App\Model\Pages::whereIn('class_id',[$ids])->limit($numbers)->get();
        return $list;
    }

    function getPostTime($postTime){
        return date('M d Y',strtotime($postTime));
    }
?>