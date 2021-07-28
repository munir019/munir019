<?php
$navList = config('newspaper.module.module');
?>
<nav class="bottom-navbar">
    <div class="container">
      <ul class="nav page-navigation">
        <?php $co=0;
        foreach($navList as $key=> $val){if($val['active']=='true'){
            echo '<li class="nav-item">';
                echo '<a href="'.$baseUrl.$val['url'].'" class="nav-link">';
                  echo '<i class="'.$val['icon'].'"></i>';
                  echo '<span class="menu-title">'.trans('news.'.$key).'</span>';
                  //echo '<span class="menu-title">'.$val['display_name'].trans('news.'.$key).'</span>'
                echo'</a>';
                if(!empty($val['child'])){
                    $child_list = $val['child'];
                      echo '<i class="menu-arrow"></i>';
                        echo '<div class="submenu">';
                            echo '<ul class="submenu-item">';
                                foreach($child_list as $nav => $data){
                                 
                                 // if($data['active']=='true'){
                                  echo '<li class="nav-item">';
                                    echo '<a class="nav-link" href="'.$baseUrl.$data['url'].'">'.trans('news.'.$nav).'</a>';
                                    //echo '<a class="nav-link" href="'.$baseUrl.$data['url'].'">'.$data['display_name'].'</a>';
                                  echo  '</li>';
                                  }  
                                //}
                                //dd($data);
                            echo'</ul>';
                        echo  '</div>';
                  }
            echo '</li>';
          $co++;    
        }}?>
      </ul>  
    </div>
</nav>
