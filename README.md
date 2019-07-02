# StudentSelector 添码俱乐部项目——点名系统

<p style="color: red;font-weight: bolder">⚠ 本项目已经荒废并被放弃。较新的开发进度在 <a href="https://github.com/pkuschool/StudentSelector-Electron">StudentSelector-Electron（点名系统Plus）</a> 进行，且不再使用PHP。</p>

## 代码规范
- 缩进！！缩进！！缩进！！！
- 变量和函数名不得中英文拼音混杂，应为100%英文
- coding 100% utf-8
### 变量规范
- 用户提交变量使用"s_"作为开头
- 其他自便
## 版本管理
- 稳定版出现后应推到另一个branch

## 外部库使用
- 使用了 [normalize.css](https://github.com/necolas/normalize.css)
- 使用了 [anijs](https://github.com/anijs/anijs)

## Known Issues
- main.php - 为了正常运行，本地**必须**安装 ds Library。
- main.php - Toast不会正常显示

## 部署
- 需要 PHP 7.*，安装扩展：ds
- 拖入相关文件夹即可。目前正常流程不会读取数据库。
- 如需要连接数据库，请创建dbpwd.php，代码如下：
```php
<?php $dbpwd = "MYSQL USER PASSWORD"; ?>
```
