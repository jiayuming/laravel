var navs = [{
	"title" : "后台首页",
	"icon" : "icon-computer",
	"href" : "page/main.html",
	"spread" : false
},{
    "title" : "网站设置",
    "icon" : "fa-cog",
    "href" : "admin/setting",
    "spread" : false
},{
    "title" : "导航管理",
    "icon" : "fa-bars",
    "href" : "admin/menus",
    "spread" : false
},{
    "title" : "用户权限管理",
    "icon": "&#xe613;",
    "href" : "",
    "spread" : false,
    "children" : [
        {
            "title" : "所有用户",
            "icon" : "&#xe612;",
            "href" : "admin/users",
            "spread" : false
        },
        {
            "title" : "角色管理",
            "icon" : "&#xe613;",
            "href" : "admin/roles",
            "spread" : false
        },
        {
            "title" : "权限管理",
            "icon" : "icon-wenben",
            "href" : "admin/permissions",
            "spread" : false
        }
    ]
},{
    "title" : "内容管理",
    "icon": "fa-book",
    "href" : "",
    "spread" : false,
    "children" : [
        {
            "title" : "文章分类",
            "icon" : "fa-tasks",
            "href" : "admin/pagesclass",
            "spread" : false
        },
        {
            "title" : "文章管理",
            "icon" : "fa-file-text-o",
            "href" : "admin/pages",
            "spread" : false
        },
        {
            "title" : "页面管理",
            "icon" : "fa-file-o",
            "href" : "admin/page",
            "spread" : false
        }
    ]
}]