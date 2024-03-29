## [WeeabooArt](https://befitting-literature-a91.notion.site/WeeabooArt-3a18979db3dd4e12a816db0cf0167f20)

เว็บแอปพลิเคชัน community ออนไลน์ เป็นพื้นที่สำหรับให้ศิลปินแสดงผลงาน และสำหรับคนที่ชื่นชอบงานศิลปะ โดย WeeabooArt จะเป็นแหล่งในการโชว์ผลงาน แหล่งซื้อ-ขายงานศิลปะ (commission) และพื่นที่แลกเปลี่ยนความคิด

## Member
- [ssunny-mengg](https://github.com/ssunny-mengg) เขมาพร งามสิริเรืองสกุล (หมิง) 6310400924
- [Punyaphon-Lammapor](https://github.com/Punyaphon-Lammapor) ปุณยพร รัมมะพ้อ (หมอก) 6310401050
- [bluwbyu](https://github.com/bluwbyu) รมิตา วิสุทธิ์วัฒนศักดิ์ (บิว) 6310401149
- [lly3](https://github.com/lly3) วิทยา พิมพ์ตา (วิท) 6310401157
- [Thjetiya](https://github.com/Thjetiya) เจติยา ธนจุติพร (อ๋อม) 6310403958
- [kritsada-kr](https://github.com/kritsada-kr) กฤษดา เครือเสนา (นน) 6310406256

โปรเจคนี้เป็นส่วนหนึ่งของวิชา Introduction to Software Engineering (01418471) และ วิชา Web Technology and Web Services (01418442)

# Project setup
## Production
- Frontend: https://weeaboo-art.vercel.app/
- Backend: https://weeabooart-production.up.railway.app/ (sorry, the server is already down...)

## (Optional) Running project localhost 
### Installing Composer Dependencies
```sh
docker run --rm \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

### Start all of the Docker containers in the background
```sh
cp .env.example .env

./vendor/bin/sail up -d

./vendor/bin/sail artisan key:generate

./vendor/bin/sail artisan storage:link && mkdir storage/images
```

### Start frontend server localhost
```sh
cd client
docker-compose up -d
```
### Install npm dependencies
```sh
docker-compose exec app npm install
```
### Start frontend server
```sh
docker-compose exec app npm run dev
```
Then access to http://localhost:3000

## Personas
#### Amelia Watson
- อายุ : 20 ปี
- สถานะภาพ : โสด
- อาชีพ : นักศึกษา
- ที่อยู่ : กรุงเทพมหานคร
- ประวัติ : Amelia Watson เป็นนักศึกษาที่กำลังศึกษาในคณะวิทยาการคอมพิวเตอร์ในมหาวิทยาลัยแห่งหนึ่ง มีงานอดิเรกที่ชอบในการวาดรูป โดยฝีมือวาดรูปนั้นถือว่ามีความชำนาญอยู่ในระดับหนึ่ง ในเวลาว่างนั้นส่วนใหญ่ Amelia มักจะวาดรูปที่เกี่ยวกับการ์ตูนและแอนิเมชันอยู่เสมอ รูปที่ Amelia วาดส่วนใหญ่นั้นจะเป็นรูปที่วาดใน
ไอแพด ซึ่งรูปที่ได้ออกมานั้นจะเป็นรูปวาดประเภทดิจิตอล ในหลายๆครั้งเธอมักจะเข้าไปดูในแอพลิเคชันอย่างเช่น twitter หรือแอพลิเคชัน social media ต่างๆ ตาม tags ชื่อเรื่องแอนิเมชันที่เธอชอบเพื่อดูผลงานอื่น ที่คนอื่นสร้างสรรค์ขึ้นมา
- Desires/Behaviors : อยากจะมีแหล่งที่สามารถติดตามผลงานของคนอื่นได้แบบง่ายๆและสามารถติดตาม tag ได้อย่างง่ายดาย, อยากสามารถแลกเปลี่ยนความคิดเห็นในสิ่งที่ชอบคล้ายๆกันได้, อยากแบ่งปันผลงานของตัวเองให้คนอื่นได้มาแสดงความคิดเห็นเพื่อแลกเปลี่ยน feedback หรือความคิดเห็นกัน
- Pain Points : ในหลายๆครั้งการตาม tag ใน social media application ไม่ได้มีเป็นแหล่งสถานที่สำหรับแชร์หรือแบ่งปันผลงานเท่านั้น ทำให้ติดตามหรือแบ่งปันผลงานกับผู้อื่นได้อย่างลำบาก

#### Mori Calliope
- อายุ : 48 ปี
- สถานะภาพ : สมรส
- อาชีพ : ธุรกิจส่วนตัว
- ที่อยู่ : ปทุมธานี
- ประวัติ : Mori Calliope เป็นนักธุรกิจที่ประกอบธุรกิจส่วนตัวเกี่ยวกับด้านอุตสาหกรรมรถยนต์ แต่ก็เป็นคนที่ชอบในผลงานศิลปะด้านต่างๆ โดยที่ชอบที่สุดนั้นจะเป็นผลงานที่มาจาก แอนิเมชันที่ตัวเองชื่นชอบ Mori มักจะสะสมผลงานด้านนี้อยู่เสมอไม่ว่าจะเป็น ตัวละครโมเดลจากการ์ตูน หรือจะเป็นผลงานที่วาดโดยนักวาดต่างๆ เช่น ผลงาน Fan arts ก็มีการเก็บสะสมเช่นเดียวกัน โดยส่วนใหญ่จะเป็นผลงานดิจิตอล เขามักชอบที่จะสนับสนุนศิลปินอยู่เสมอผ่านการซื้อภาพวาดต่างๆ
- Desires/Behaviors : เป็นคนชอบสะสมผลงานที่เกี่ยวกับแอนิเมชันที่ตัวเองชื่นชอบอยู่เสมอ, อยากให้มีการแยกผลงานที่สามารถซื้อสะสมได้เพื่อที่ง่ายต่อการสนับสนุนตัวศิลปินและการเลือกซื้อสะสม
- Pain Points : ในบางครั้งการติดตามผลงานของศิลปินเดียวกันที่ชื่นชอบเป็นพิเศษมักจะทำได้ยาก 

#### Takanashi Kiara
- อายุ : 24 ปี
- สถานะภาพ : โสด
- อาชีพ : ฟรีแลนซ์
- ที่อยู่ : นนทบุรี
- ประวัติ :  Takanashi Kiara เป็นฟรีแลนซ์ที่จบจากการศึกษามหาวิทยาลัยได้ไม่นาน โดยสาขาที่จบมานั้นเกี่ยวกับด้าน digital art ทำให้สนใจที่จะหารายได้และประกอบอาชีพทางด้านนี้เป็นหลัก Takanashi มีความเชี่ยวชาญในการวาดรูปและสร้างสรรค์ผลงานได้อย่างดีเยี่ยม
- Desires/Behaviors : ต้องการจะหารายได้จากด้านนี้เป็นหลักในการดำรงชีวิตและประกอบอาชีพ เนื่องจากเป็นสายงานที่ชอบ, อยากให้มีแหล่งหรือสถานที่สำหรับการขายงานโดยเฉพาะ โดยอาจจะเป็นงานที่ลูกค้าเป็นคนกำหนดมาโดยตรงได้หรืองานประเภท commission หรือเป็นการขายงานโดยตัวศิลปินเอง
- Pain Points : ในหลายๆครั้งผลงานที่ถูกนำออกมาขายมักจะมีการโดนละเมิดลิขสิทธิ์ โดยบางทีเป็นการ save รูปหรือผลงานจากหน้าเว็บโดยไม่ได้มีการซื้อขายก่อนนำไปใช้


## UI Flows

Figma : https://www.figma.com/file/VhDbySZqtW4O9r1dCjo4f5/UI-Flows-WeeabooArt?node-id=1%3A2

![UI Flows](https://github.com/lly3/WeeabooArt/blob/abda01d2db16a95dca572158aa7346ba1f56d5ee/UI%20Flows%20WeeabooArt.png?raw=true)

## Testing
ทดสอบด้วย Laravel โดยทดสอบทั้งในส่วนของ Feature และ Unit Test ด้วยการสร้าง Environment ขึ้นมาใหม่สำหรับการทดสอบโดยเฉพาะ และทดสอบในส่วนของการเชื่อมต่อ API ของระบบ Authentication รวมไปถึงการทดสอบของ Post และได้เขียน Test Function ดังนี้

- Test Register Success : ทดสอบการสมัครสมาชิกใหม่ โดยใช้รูปแบบข้อมูลที่ถูกต้อง และครบถ้วน
- Test Register With Password Not Match : ทดสอบการสมัครสมาชิกใหม่ โดยใช้รหัสผ่านที่ไม่ตรงกันกับการยืนยันรหัสผ่าน
- Test Login Success : ทดสอบการเข้าสู่ระบบ โดยใช้รูปแบบข้อมูลที่ถูกต้อง และครบถ้วน
- Test Login With Wrong Password : ทดสอบการเข้าสู่ระบบ โดยใช้รหัสผ่านที่ไม่ถูกต้อง
- Test New Post Have Default Values : ทดสอบการสร้าง Post ใหม่ โดยเริ่มต้นจะมีค่า Default ตามที่ได้กำหนดไว้ในฐานข้อมูล

## Process
การวางแผนและการมอบหมายงาน

Jira : https://vitaya.atlassian.net/jira/software/projects/OSSV/boards/2/backlog

