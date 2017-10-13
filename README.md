# bjjj-php

## 【使用简介】
* index.php支持多用户模式、多车辆模式（目前政策限制只允许1个用户提交一辆车的申请）
* 访问index.php会读取工程目录下users.json，遍历userid，查询车辆列表信息，然后提交申请
* postSign.php接收由Charles修改move.js所提交的sign数据，该数据为申请日00:00 - 09:00时间段内每6分钟取点时间戳，通过move.js计算出来的
* 根据模板json：car.json、person.json填写个人相关的信息，放置在对应的用户目录下 

## 【配置说明】
### 目录结构
* /
    * 根目录
* /userid
    * 各种json文件的模板文件存放目录
    * /car.json
        * 车辆信息
        * "licenseno" 车牌号
        * "engineno" 发动机型号
        * "cartypecode" 车类型
        * "vehicletype" 车辆类型
    * /person.json
        * 个人信息
        * "drivingphoto" 行驶证
        * "carphoto" 车辆正面照
        * "drivername" 姓名
        * "driverlicenseno" 身份证号
        * "driverphoto" 驾驶证
        * "personphoto" 本人持身份证照
    * /date
        * 日期目录
        * /token.json 用于获取车辆信息列表时使用
        * /sign.json  用于获取车辆信息列表时使用
        * /timestamp.json 用于最后提交申请时使用
            * 这些json文件都是由时间戳作为key取值的，取的是该日期当天的0点至9点每6分钟取一个点
* /users.json
    * 多用户模式，userid的json array
* /{userid}
    * 某个userid命名的目录，存放该用户所有的个人数据
    * /{date}
        * 日期目录
        * /{platform}
            * 平台相关，"01"是iOS，"02"是android
            * /token.json
            * /sign.json
            * /timestamp.json
                * 由postSign.php创建的用例
    * /{licenseno}
        * 车牌目录
        * /car.json
            * 用car.json模板创建的用例
        * /person.json
            * 用person.json模板创建的用例
    * /cars.json
        * 多车辆模式，默认目前一个账号只能申请一个，只取第一个
