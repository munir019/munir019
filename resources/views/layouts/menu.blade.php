<?php
$navList=config('newspaper.module.module');
?>
<section class="menu">
    <div class="container p-2">
        <nav>
            <ul class="nav">
                <?php $co=0;
                foreach($navList as $key=> $val){if($val['active']=='true'){
                    echo '<li class="nav-item">';
                    echo '<a href="'.$baseUrl.$val['url'].'" class="nav-link d-inline-block py-2">';
                    echo '<i class="'.$val['icon'].'"></i>';
                    echo '<span class="menu-title">'.trans('news.'.$key).'</span>';
                    echo'</a>';
                    if(!empty($val['child'])){
                        $child_list = $val['child'];
                        echo '<i class="menu-arrow"></i>';
                        echo '<div class="submenu">';
                        echo '<ul class="submenu-item">';
                        foreach($child_list as $nav => $data){ if($data['active']=='true'){
                            $url= str_replace('-','',$data['url']);
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link" href="'.$baseUrl.$url.'"><i class="fas fa-chevron-right"></i><span>'.trans('news.'.$nav).'</span></a>';
                            echo  '</li>';
                        }
                        }
                        echo'</ul>';
                        echo  '</div>';
                    }
                    echo '</li>';
                    $co++;
                }}?>
            </ul>
        </nav>
    </div>
</section>