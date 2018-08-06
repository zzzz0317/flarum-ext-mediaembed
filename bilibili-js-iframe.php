<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Bilibili 外链播放器跳转</title>
</head>
<body>
<h3>Bilibili 外链播放器跳转</h3>
<p>正在获取视频信息，请稍后</p>
<p>
xmlhttp: <span id="txt-xmlhttp"></span>
<br>
json: <span id="txt-json"></span>
<br>
aid: <span id="txt-aid"></span>
<br>
page: <span id="txt-page"></span>
<br>
cid: <span id="txt-cid"></span>
<br>
PlayerUrl: <span id="txt-playerurl"></span>
</p>
<script type="text/javascript">
var aid = <?php echo $_GET["aid"]; ?>;

var xmlhttp;

xmlhttp=new XMLHttpRequest();
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    json=xmlhttp.responseText;
        getid();
    }
  }
xmlhttp.open("GET",'https://www.bilibili.com/widget/getPageList?aid=' + aid ,true);
xmlhttp.send();

function getid(){
var txt = '{"api":' + json + '}';

obj = JSON.parse(txt);

var cid = obj.api[0].cid;
var page = obj.api[0].page;

document.getElementById("txt-xmlhttp").innerHTML=json;
document.getElementById("txt-json").innerHTML=txt;
document.getElementById("txt-aid").innerHTML=aid;
document.getElementById("txt-page").innerHTML=page;
document.getElementById("txt-cid").innerHTML=cid;

playerurl = '//player.bilibili.com/player.html?aid=' + aid + '&cid=' + cid + '&page=' + page;

document.getElementById("txt-playerurl").innerHTML = playerurl;

self.location = playerurl;
}
</script>
</body>
</html>
