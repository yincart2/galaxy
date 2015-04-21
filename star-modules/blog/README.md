Blog Module
===========

###Table Structure

# Post Table
```
 id
 category_id
 user_id        
 language_id    语言ID
 star_id        星球ID    
 cluster_id     星团ID
 station_id     空间站ID
 title
 url
 source
 summary
 content
 tags
 status
 views
 allow_comment
 create_time
 update_time
```

# Comment Table
```
 id
 parent_id   父ID
 post_id
 user_id
 text
 create_time
 update_time
 status
```  
赞的功能待开发，纳入声望系统

###Instruction

此模块为公用模块，可以安装在每一个云站点和独立站点上


