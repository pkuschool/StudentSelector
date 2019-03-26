# 开发文档
## 登陆结构
1. 浏览器进行操作
2. 如：在浏览器cookie检测到有效用户ID
   1. 直接登录，refresh cookie
   2. 否则：给用户呈现登陆页面
      1. 如果：用户输入的用户名已存在
        1. 展示密码输入框
           1. 如果用户忘了密码：邮件找回
           2. 如果用户没忘，进行了登录，弹出以下对话框：
                - 是否打开自动登录？如果您选择是，我们将会使用Cookie来确保你下次登陆。如果您选择否，下次需要再次输入密码。请不要在公用电脑上允许此项。
      2. 否则：展示密码输入框，明确是注册
         1. 用户输入信息，注册
            1. 注册完后，弹出：
                -  请确认您的邮件信息。我们不会验证该邮件地址，但此地址将被用于找回密码。点击确认以继续注册。
## 数据库结构
- stuselectbase => $base, utf8mb4_unicode_ci
  - userlist
    - ID => int
    - Email => text
    - DisplayName => text
    - Classes => text //班级列表，以逗号分隔
    - Password => text
  - classlist
    - ID => int
    - Name => text
- stuselectclass => $class //这一个表由php调用代码自动创建。
  - (class) // name == classlist => ID
    - ID => int //学生ID
    - DisplayName => text //学生姓名
    - weight => int [0-2] //点名权重。
    - CallTime => int [dynamic] //从头到尾被点到的次数

## SQL用户名
- root随意，不可留空
- new一个user： stuselect，密码放群里，base库开放数据，class库权限开数据和结构