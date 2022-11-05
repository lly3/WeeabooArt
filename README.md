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

## Project setup
???

## Personas
???

## UI Flows
???

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

