<?php
return array(
    'module' => array(
        'dashboard' => array(
			'display_name' => 'Dashboard',
			'title' => 'Dashboard',
			'url'   =>'',
			'icon' => 'fas fa-tachometer-alt',
            'active' =>'true',
			'child' => ''
		),
		'news_manager' => array(
			'display_name' => 'News Manager',
			'title' => 'News Manager',
			'url'   =>'news-manager',
            'icon' => 'far fa-newspaper',
            'active' =>'true',
			'child' => array(

                'date_setup' => array(
                    'display_name' => 'Date Setup',
                    'title' => 'Date Setup',
                    'url'   =>'date',
                    'icon' => 'fa-home',
                    'active' =>'true',
                ),
        
                'news_category' => array(
                    'display_name' => 'News Category',
                    'title' => 'News Category ',
                    'url'   =>'news-category',
                    'icon' => 'fa-home',
                    'active' =>'true',
                ),
        
                'news_list' => array(
                    'display_name' => 'News List',
                    'title' => 'News List',
                    'url'   =>'news-list',
                    'icon' => 'fa-home',
                    'active' =>'true',
        
                ),
        
                'breaking_news' => array(
                    'display_name' => 'Breaking News',
                    'title' => 'Breaking News',
                    'url'   =>'breakingnews',
                    'icon' => 'fa-home',
                    'active' =>'true',
        
                ),
                'opinion_poll' => array(
        
                    'display_name' => 'Opinion Poll',
                    'title' => 'Opinion Poll',
                    'url'   =>'opinion-poll',
                    'icon' => 'fa-home',
                    'active' =>'true',
                ),
                'epaper' => array(
        
                    'display_name' => 'Epaper',
                    'title' => 'Epaper',
                    'url'   =>'epaper-link',
                    'icon' => 'fa-home',
                    'active' =>'true',
                ),
                'bulk_news_entry' => array(
        
                    'display_name' => 'Bulk News Entry',
                    'title' => 'Bulk News Entry',
                    'url'   =>'bulk-news-entry',
                    'icon' => 'fa-home',
                    'active' =>'true',
                ),
            ) // Child End
		),
        'photo_manager' => array(
			'display_name' => 'Photo Manager',
			'title' => 'Photo Manager',
			'url'   =>'photo-manager',
            'icon' => 'fas fa-camera-retro',
			'active' =>'true',
            'child' => array(

                'photo_category' => array(
                    'display_name' => 'Photo Category',
                    'title' => 'Photo Category',
                    'url'   =>'photo-category',
                    'icon' => '',
                    'active' =>'true',
                ),
                'photo_album' => array(
                    'display_name' => 'Photo Album',
                    'title' => 'Photo Album ',
                    'url'   =>'photo-album',
                    'icon' => 'fa-home',
                    'active' =>'true',
                ),
            ) // Child End
        ),
        'video_manager' => array(
            'display_name' => 'Video Manager',
            'title' => 'Video Manager',
            'url'   =>'video-manager',
            'icon' => 'fas fa-video',
            'active' =>'true',
            'child' => array(

                'video_category' => array(
                    'display_name' => 'Video Category',
                    'title' => 'Video Category',
                    'url'   =>'video-category',
                    'icon' => '',
                    'active' =>'true',
                ),
        
                'video_list' => array(
        
                    'display_name' => 'Video List',
                    'title' => 'Video List ',
                    'url'   =>'video-list',
                    'icon' => '',
                    'active' =>'true',
                ),
        
                
            ) // Child End
        ),
        'user_manager' => array(
			'display_name' => 'User Manager',
			'title' => 'User Manager',
			'url'   =>'user-manager',
			'icon' => 'fas fa-user-cog',
            'active' =>'true',
			'child' => array(

                'group_user' => array(
                    'display_name' => 'Group User',
                    'title' => 'Group User',
                    'url'   =>'group-user',
                    'icon' => '',
                    'active' =>'true',
                ),
        
                'list_user' => array(
        
                    'display_name' => 'List User',
                    'title' => 'List User ',
                    'url'   =>'list-user',
                    'icon' => '',
                    'active' =>'true',
                ),
        
                
            ) // Child End
		),
        'engine_setting' => array(
			'display_name' => 'Engine Setting',
			'title' => 'Engine Setting',
			'url'   =>'engine-setting',
			'icon' => 'fas fa-cogs',
            'active' =>'true',
			'child' => array(

                'general_setting' => array(
        
                    'display_name' => 'General Setting',
                    'title' => 'General Setting',
                    'url'   =>'General Setting',
                    'icon' => '',
                    'active' =>'true',
                ),
        
                'social_network' => array(
        
                    'display_name' => 'Social Network',
                    'title' => 'Social Network',
                    'url'   =>'socialnetwork',
                    'icon' => '',
                    'active' =>'true',
                ),
                'template_setup' => array(
        
                    'display_name' => 'Template Setup',
                    'title' => 'Template Setup',
                    'url'   =>'templatesetup',
                    'icon' => '',
                    'active' =>'true',
                ),
                'add_setup' => array(
        
                    'display_name' => 'Add Setup',
                    'title' => 'Add Setup',
                    'url'   =>'addsetup',
                    'icon' => '',
                    'active' =>'true',
                ),
        
                
            ) // Child End
		),
        'accessories' => array(
			'display_name' => 'Accessories',
			'title' => 'Accessories',
			'url'   =>'accessories',
			'icon' => 'fas fa-sliders-h',
            'active' =>'true',
			'child' => array(

                'tag_list' => array(
                    'display_name' => 'Tag List',
                    'title' => 'Tag List',
                    'url'   =>'taglist',
                    'icon' => '',
                    'active' =>'true',
                ),
        
                'special_tag' => array(
                    'display_name' => 'Special Tag',
                    'title' => 'Special Tag',
                    'url'   =>'specialtag',
                    'icon' => '',
                    'active' =>'true',
                ),
                'task_monitoring' => array(
                    'display_name' => 'Task Monitoring',
                    'title' => 'Task Monitoring',
                    'url'   =>'taskmonitoring',
                    'icon' => '',
                    'active' =>'true',
                ),
                'reporter_list' => array(
                    'display_name' => 'Reporter List',
                    'title' => 'Reporter List',
                    'url'   =>'reporterList',
                    'icon' => '',
                    'active' =>'true',
                ),
                'bangladeshi_district' => array(
                    'display_name' => 'Bangladeshi District',
                    'title' => 'Bangladeshi District',
                    'url'   =>'bangladeshidistrict',
                    'icon' => '',
                    'active' =>'true',
                ),
                'bangladeshi_thana' => array(
                    'display_name' => 'Bangladeshi thana',
                    'title' => 'Bangladeshi Thana',
                    'url'   =>'bangladeshithana',
                    'icon' => '',
                    'active' =>'true',
                ),
        
                
            ) // Child End
		),
        
		
    ),
 );