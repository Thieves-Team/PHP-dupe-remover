<style type="text/css">
body {
background: #000000;
}
 
#container {
width: 800px;
background: #800000;
}
span {
color:white;
}
 
#left {
float:left;
height: 200px;
width:256px !important;
overflow:hidden;
padding: 10px;
}
#right {
border: 1px solid green;
float:right;
width: 500px !important;
overflow:hidden;
padding: 10px;
}
 
ul.vert-one {
margin:0;
padding:0;
list-style-type:none;
display:block;
font:bold 20px Helvetica, Verdana, Arial, sans-serif;
line-height:165%;
width:160px;
padding-top:50px;
}
 
 
ul.vert-one li {
margin:0;
padding:1px;
border-top:1px solid #000;
border-bottom:1px solid ;
}
 
ul.vert-one li a {
display:block;
text-decoration:none;
color:#fff;
background:#061F0B;
padding:0 0 0 0px;
width:160px;
padding-top:5px;
padding-bottom:5px;
}
 
 
ul.vert-one li a:hover {
background:#0E2510 url("data/images/vert-one_arrow.gif") no-repeat 0 17px;
}
 
ul.vert-one li a.current,ul.vert-one li a.current:hover {
background:#06420C url("data/images/vert-one_arrow.gif") no-repeat 0 17px;
}
 
 
#a3 {
-webkit-border-bottom-right-radius: 10px;
-webkit-border-bottom-left-radius: 10px;
-moz-border-radius-bottomright: 10px;
-moz-border-radius-bottomleft: 10px;
border-bottom-right-radius: 10px;
border-bottom-left-radius: 10px;
}
 
 
#a1 {
-webkit-border-top-left-radius: 10px;
-webkit-border-top-right-radius: 10px;
-moz-border-radius-topleft: 10px;
-moz-border-radius-topright: 10px;
border-top-left-radius: 10px;
border-top-right-radius: 10px;
}
 
.form {
text-align:left;
}
 
</style>
<body>
        <center>
                <a href="http://forum.thieves-team.com"><img src="http://img231.imageshack.us/img231/7871/thiev.png"></a>
                <div id="container">
                        <div id="left">
                                <nav>
                                         <ul class="vert-one">
                                                <?php
                                                if(isset($_GET['page'])) { $page = $_GET['page']; }
                                                if(isset( $_SERVER['PHP_SELF'])) {$self = $_SERVER['PHP_SELF'];}
                                                if($page == '') {
                                                        echo '<li><a href="'.$self.'?page=" id="a1" class="current" > Home </a></li>';
                                                }else{
                                                        echo '<li><a href="'.$self.'?page=" id="a1" > Home </a></li>';
                                                }      
 
                                                if($page == 'fromtextarea') {
                                                        echo ' <li><a href="'.$self.'?page=fromtextarea" class="current" > From textarea </a></li>';
                                                }else{
                                                        echo '<li><a href="'.$self.'?page=fromtextarea"  > From textarea </a></li>';
                                                }
 
                                                if($page == 'fromfile') {
                                                        echo '<li><a href="'.$self.'?page=fromfile" id="a3"  class="current"> From file </a></li>';
                                                }else{
                                                        echo '<li><a href="'.$self.'?page=fromfile" id="a3" > From file </a></li>';
                                                }
                                                ?>
                                        </ul>
                                </nav>         
                        </div>
                        <div id="right">
                                <?php
                                        $form_text = '<form action="" method="post" ><textarea name="textarea" cols="30" rows="10"></textarea><br /><br /><select name="delimiter"><option value="1">Space: " "</option><option value="2">New line: "\n"</option><option value="3">Comma: ","</option></select><br /><br /><input type="submit" name="delete" value="Delete"></form>';
                                        $form_file = '<form class="form" action="" method="post" enctype="multipart/form-data"><input type="file" name="upload"><br /><br /><select name="delimiter"><option value="1">Space: " "</option><option value="2">New line: "\n"</option><option value="3">Comma: ","</option></select><br /><br /><input type="submit" name="delete" value="Delete"></form>';
                                        if($page == '') {
                                        echo '<span>Now, you can remove your duplicates with thies tool<br />Credits: Synthesis.</span><br />';
                                        }
                                        if($page == 'fromtextarea') {
                                                echo $form_text;
                                                if(isset($_POST['delete'])) {
                                                        if(!empty($_POST['textarea'])) {
                                                                $delimiter = (int)$_POST['delimiter'];
                                                                $arr_del = array(1=>" ",2=>"\n",3=>",");
                                                                $delimiter2 = $arr_del[$delimiter];
                                                                echo '<span>'.implode($delimiter2, array_unique(explode($delimiter2,$_POST['textarea']))).'</span>';
                                                        }
                                                        if(empty($_POST['textarea'])) {
                                                                echo '<span>You haven`t provided any data.</span>';
                                                        }
                                                }              
                                        }
                                        if($page == 'fromfile') {
                                                echo $form_file;
                                                if(isset($_POST['delete'])) {
                                                        if(!empty($_FILES['upload']['tmp_name'])) {
                                                                if($_FILES['upload']['type'] == 'text/plain') {
                                                                        $delimiter = (int)$_POST['delimiter'];
                                                                        $arr_del = array(1=>" ",2=>"\n",3=>",");
                                                                        $delimiter2 = $arr_del[$delimiter];
                                                                        $file = $_FILES['upload']['tmp_name'];
                                                                        $data = file_get_contents($file);
                                                                        echo '<span>'.implode($delimiter2, array_unique(explode($delimiter2,$data))).'</span>';
                                                                }
                                                                if($_FILES['upload']['type'] != 'text/plain') {
                                                                        echo '<span>File must be text/plain.</span>';
                                                                }
                                                        }
                                                        if(empty($_FILES['upload']['tmp_name'])) {
                                                                echo '<span>You haven`t provided any data.</span>';
                                                        }      
                                                }      
                                        }
                                ?>
                        </div>
                </div>
        </center>
</body>
