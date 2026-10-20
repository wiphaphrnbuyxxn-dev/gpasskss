<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WAC10 Grade Viewer - ระบบแสดงผลการเรียน</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Sarabun', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="flex flex-col min-h-screen text-gray-800 antialiased p-4 sm:p-6 md:p-8">

    <header class="max-w-4xl mx-auto w-full mb-6 text-center">
        <div class="inline-flex items-center gap-3 bg-white/80 px-6 py-2.5 rounded-full shadow-sm border border-white">
            <i class="fa-solid fa-graduation-cap text-2xl text-orange-500"></i>
            <h1 class="text-xl font-bold bg-gradient-to-r from-orange-600 to-amber-600 bg-clip-text text-transparent">
                WAC10 Grade Viewer
            </h1>
        </div>
    </header>

    <main class="max-w-4xl mx-auto w-full flex-1 flex flex-col justify-center">

        <!-- FORM CARD (Input Page) -->
        <div id="formContainer" class="glass-card rounded-2xl p-6 sm:p-10 transition-all duration-300">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-800">ระบบแสดงผลการเรียน</h2>
                <p class="text-gray-500 text-sm mt-1">กรุณากรอกข้อมูลเพื่อเข้าสู่ระบบค้นหาเกรด</p>
            </div>

            <form id="gradeForm" onsubmit="event.preventDefault(); searchGrade();" class="space-y-5 max-w-md mx-auto">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">เลขประจำตัวนักเรียน</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            <i class="fa-solid fa-id-card"></i>
                        </div>
                        <input type="text" id="studentID" placeholder="เช่น 68063467" 
                            class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors text-gray-800 placeholder-gray-400 text-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">วันเกิด (วว/ดด/ปปปป)</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            <i class="fa-solid fa-calendar-days"></i>
                        </div>
                        <input type="text" id="bDate" placeholder="เช่น 09/03/2555" 
                            class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors text-gray-800 placeholder-gray-400 text-sm">
                    </div>
                </div>

                <!-- Alert Box -->
                <div id="errorMessage" class="hidden p-3 rounded-lg bg-red-50 text-red-600 text-sm flex items-center gap-2 border border-red-200">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span id="errorText"></span>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" 
                        class="flex-1 bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 text-white font-medium py-2.5 px-4 rounded-xl shadow-md hover:shadow-lg transition-all text-sm flex items-center justify-center gap-2">
                        <i class="fa-solid fa-magnifying-glass"></i> แสดงผลการเรียน
                    </button>
                    <button type="reset" onclick="hideError()" 
                        class="bg-gray-100 hover:bg-gray-200 text-gray-600 font-medium py-2.5 px-4 rounded-xl transition-colors text-sm">
                        ล้างข้อมูล
                    </button>
                </div>
            </form>
        </div>

        <!-- RESULT CARD (Display Page) -->
        <div id="resultContainer" class="hidden glass-card rounded-2xl p-6 sm:p-8 transition-all duration-300">
            <!-- Top Controls -->
            <div class="flex items-center justify-between pb-4 mb-6 border-b border-gray-200">
                <button onclick="showForm()" class="inline-flex items-center gap-2 text-sm font-medium text-orange-600 hover:text-orange-700 bg-orange-50 hover:bg-orange-100 px-3 py-1.5 rounded-lg transition-colors">
                    <i class="fa-solid fa-arrow-left"></i> กลับหน้าค้นหา
                </button>
                <span class="text-sm font-bold text-gray-700">ระบบแสดงผลการเรียน</span>
            </div>

            <div id="studentDetailArea">
                <!-- Data rendered dynamically -->
            </div>

            <!-- Back Button at bottom -->
            <div class="mt-6 pt-4 border-t border-gray-100">
                <button onclick="showForm()" class="text-sm text-gray-500 hover:text-gray-800 flex items-center gap-1">
                    <i class="fa-solid fa-chevron-left"></i> ย้อนกลับ
                </button>
            </div>
        </div>

    </main>

    <!-- Footer -->
    <footer class="mt-8 text-center text-xs text-gray-500">
        <p>© WAC10 Grade Viewer System. All rights reserved.</p>
    </footer>

    <script>
        const xmlData = `<?xml version="1.0" encoding="utf-8"?>
<Stds>
<Std><Psn><Co>68063467</Co><Na>เด็กชายมังกร   อุ้ยรัมย์</Na><BD>09/03/2555</BD><CR>มัธยมศึกษาปีที่ 2</CR>
<Th>2.50</Th><Ma>2.33</Ma><Sc>2.45</Sc><So>2.41</So><He>3.81</He><Ar>3.66</Ar><Jo>3.33</Jo><En>1.33</En><GP>2.95</GP></Psn><Trs>
<Tr><Se><Yr>2568</Yr><Tm>ภาคเรียนที่ 1</Tm>
<GA>2.98</GA></Se><Ss>
<S><C>3033</C><G>2.5</G></S><S><C>3034</C><G>2</G></S><S><C>3035</C><G>3</G></S><S><C>3109</C><G>3.5</G></S>
<S><C>3037</C><G>3</G></S><S><C>3038</C><G>3.5</G></S><S><C>3039</C><G>4</G></S><S><C>3040</C><G>4</G></S>
<S><C>3041</C><G>3.5</G></S><S><C>3042</C><G>4</G></S><S><C>3043</C><G>1</G></S><S><C>3047</C><G>3.5</G></S>
<S><C>3050</C><G>ผ</G></S><S><C>3051</C><G>ผ</G></S><S><C>3052</C><G>ผ</G></S><S><C>3053</C><G>ผ</G></S>
</Ss></Tr>
<Tr><Se><Yr>2568</Yr><Tm>ภาคเรียนที่ 2</Tm>
<GA>2.75</GA></Se><Ss>
<S><C>3054</C><G>2</G></S><S><C>3055</C><G>2.5</G></S><S><C>3056</C><G>1.5</G></S><S><C>3036</C><G>1</G></S>
<S><C>3058</C><G>2</G></S><S><C>3110</C><G>1</G></S><S><C>3111</C><G>3</G></S><S><C>3112</C><G>4</G></S>
<S><C>3113</C><G>3.5</G></S><S><C>3114</C><G>2</G></S><S><C>3115</C><G>2</G></S><S><C>3119</C><G>4</G></S>
<S><C>3122</C><G>ผ</G></S><S><C>3123</C><G>ผ</G></S><S><C>3124</C><G>ผ</G></S><S><C>3125</C><G>ผ</G></S>
</Ss></Tr>
<Tr><Se><Yr>2569</Yr><Tm>ภาคเรียนที่ 1</Tm>
<GA>3.12</GA></Se><Ss>
<S><C>3350</C><G>3</G></S><S><C>3351</C><G>2.5</G></S><S><C>3352</C><G>3</G></S><S><C>3353</C><G>2.5</G></S>
<S><C>3354</C><G>2</G></S><S><C>3355</C><G>3.5</G></S><S><C>3356</C><G>3.5</G></S><S><C>3357</C><G>4</G></S>
<S><C>3358</C><G>4</G></S><S><C>3359</C><G>4</G></S><S><C>3360</C><G>1</G></S><S><C>3365</C><G>4</G></S>
<S><C>3368</C><G>ผ</G></S><S><C>3369</C><G>ผ</G></S><S><C>3371</C><G>ผ</G></S><S><C>3370</C><G>ผ</G></S>
</Ss></Tr>
</Trs></Std>
<Std><Psn><Co>68063403</Co><Na>เด็กชายกฤษฎ์   สุพรรณ์</Na><BD>05/07/2555</BD><CR>มัธยมศึกษาปีที่ 2</CR>
<Th>4.00</Th><Ma>3.66</Ma><Sc>3.66</Sc><So>3.95</So><He>4.00</He><Ar>4.00</Ar><Jo>3.83</Jo><En>4.00</En><GP>3.91</GP></Psn><Trs>
<Tr><Se><Yr>2568</Yr><Tm>ภาคเรียนที่ 1</Tm>
<GA>3.82</GA></Se><Ss>
<S><C>3033</C><G>4</G></S><S><C>3034</C><G>3.5</G></S><S><C>3035</C><G>3</G></S><S><C>3109</C><G>3.5</G></S>
<S><C>3037</C><G>4</G></S><S><C>3038</C><G>3.5</G></S><S><C>3039</C><G>4</G></S><S><C>3040</C><G>4</G></S>
<S><C>3041</C><G>4</G></S><S><C>3042</C><G>4</G></S><S><C>3043</C><G>4</G></S><S><C>3045</C><G>4</G></S>
<S><C>3050</C><G>ผ</G></S><S><C>3051</C><G>ผ</G></S><S><C>3052</C><G>ผ</G></S><S><C>3053</C><G>ผ</G></S>
</Ss></Tr>
<Tr><Se><Yr>2568</Yr><Tm>ภาคเรียนที่ 2</Tm>
<GA>3.96</GA></Se><Ss>
<S><C>3054</C><G>4</G></S><S><C>3055</C><G>4</G></S><S><C>3056</C><G>4</G></S><S><C>3036</C><G>3.5</G></S>
<S><C>3058</C><G>4</G></S><S><C>3110</C><G>4</G></S><S><C>3111</C><G>4</G></S><S><C>3112</C><G>4</G></S>
<S><C>3113</C><G>4</G></S><S><C>3114</C><G>3.5</G></S><S><C>3115</C><G>4</G></S><S><C>3117</C><G>4</G></S>
<S><C>3122</C><G>ผ</G></S><S><C>3123</C><G>ผ</G></S><S><C>3124</C><G>ผ</G></S><S><C>3125</C><G>ผ</G></S>
</Ss></Tr>
<Tr><Se><Yr>2569</Yr><Tm>ภาคเรียนที่ 1</Tm>
<GA>3.95</GA></Se><Ss>
<S><C>3350</C><G>4</G></S><S><C>3351</C><G>3.5</G></S><S><C>3352</C><G>4</G></S><S><C>3353</C><G>4</G></S>
<S><C>3354</C><G>4</G></S><S><C>3355</C><G>4</G></S><S><C>3356</C><G>4</G></S><S><C>3357</C><G>4</G></S>
<S><C>3358</C><G>4</G></S><S><C>3359</C><G>4</G></S><S><C>3360</C><G>4</G></S><S><C>3363</C><G>4</G></S>
<S><C>3368</C><G>ผ</G></S><S><C>3369</C><G>ผ</G></S><S><C>3371</C><G>ผ</G></S><S><C>3370</C><G>ผ</G></S>
</Ss></Tr>
</Trs></Std>
</Stds>`;

        const subjectMasterDict = {
            "3033": { C: "ท21101", N: "ภาษาไทย 1", R: "1.5" },
            "3034": { C: "ค21101", N: "คณิตศาสตร์ 1", R: "1.5" },
            "3035": { C: "ว21101", N: "วิทยาศาสตร์ 1", R: "1.5" },
            "3109": { C: "ว21102", N: "วิทยาการคำนวณ 1", R: "0.5" },
            "3037": { C: "ส21101", N: "สังคมศึกษา 1", R: "1.5" },
            "3038": { C: "ส21102", N: "ประวัติศาสตร์ 1", R: "0.5" },
            "3039": { C: "พ21101", N: "สุขศึกษา 1", R: "0.5" },
            "3040": { C: "พ21102", N: "พลศึกษา 1", R: "0.5" },
            "3041": { C: "ศ21101", N: "ศิลปะ 1", R: "1.0" },
            "3042": { C: "ง21101", N: "การงานอาชีพ 1", R: "0.5" },
            "3043": { C: "อ21101", N: "ภาษาอังกฤษ 1", R: "1.5" },
            "3045": { C: "อ20201", N: "ภาษาอังกฤษฟัง-พูด 1", R: "1.0" },
            "3046": { C: "ง20201", N: "งานเกษตร 1", R: "1.0" },
            "3047": { C: "ค20201", N: "คณิตศาสตร์เพิ่มเติม 1", R: "1.0" },
            "3049": { C: "ว20201", N: "พรีออลิมปิกวิทย์ 1", R: "1.0" },
            "3050": { C: "ก21901", N: "แนะแนว 1", R: "0" },
            "3051": { C: "ก21902", N: "ลูกเสือ-เนตรนารี 1", R: "0" },
            "3052": { C: "ก21903", N: "ชุมนุม 1", R: "0" },
            "3053": { C: "ก21904", N: "กิจกรรมเพื่อสังคม 1", R: "0" },
            "3054": { C: "ท21102", N: "ภาษาไทย 2", R: "1.5" },
            "3055": { C: "ค21102", N: "คณิตศาสตร์ 2", R: "1.5" },
            "3056": { C: "ว21103", N: "วิทยาศาสตร์ 2", R: "1.5" },
            "3036": { C: "ว21104", N: "การออกแบบและเทคโนโลยี 1", R: "0.5" },
            "3058": { C: "ส21103", N: "สังคมศึกษา 2", R: "1.5" },
            "3110": { C: "ส21104", N: "ประวัติศาสตร์ 2", R: "0.5" },
            "3111": { C: "พ21103", N: "สุขศึกษา 2", R: "0.5" },
            "3112": { C: "พ21104", N: "พลศึกษา 2", R: "0.5" },
            "3113": { C: "ศ21102", N: "ศิลปะ 2", R: "1.0" },
            "3114": { C: "ง21102", N: "การงานอาชีพ 2", R: "0.5" },
            "3115": { C: "อ21102", N: "ภาษาอังกฤษ 2", R: "1.5" },
            "3117": { C: "อ20202", N: "ภาษาอังกฤษฟัง-พูด 2", R: "1.0" },
            "3118": { C: "ง20202", N: "งานเกษตร 2", R: "1.0" },
            "3119": { C: "ค20202", N: "คณิตศาสตร์เพิ่มเติม 2", R: "1.0" },
            "3121": { C: "ว20202", N: "พรีออลิมปิกวิทย์ 2", R: "1.0" },
            "3122": { C: "ก21905", N: "แนะแนว 2", R: "0" },
            "3123": { C: "ก21906", N: "ลูกเสือ-เนตรนารี 2", R: "0" },
            "3124": { C: "ก21907", N: "ชุมนุม 2", R: "0" },
            "3125": { C: "ก21908", N: "กิจกรรมเพื่อสังคม 2", R: "0" },
            "3350": { C: "ท22101", N: "ภาษาไทย 3", R: "1.5" },
            "3351": { C: "ค22101", N: "คณิตศาสตร์ 3", R: "1.5" },
            "3352": { C: "ว22101", N: "วิทยาศาสตร์ 3", R: "1.5" },
            "3353": { C: "ว22102", N: "วิทยาการคำนวณ 2", R: "0.5" },
            "3354": { C: "ส22101", N: "สังคมศึกษา 3", R: "1.5" },
            "3355": { C: "ส22102", N: "ประวัติศาสตร์ 3", R: "0.5" },
            "3356": { C: "พ22101", N: "สุขศึกษา 3", R: "0.5" },
            "3357": { C: "พ22102", N: "พลศึกษา 3", R: "0.5" },
            "3358": { C: "ศ22101", N: "ศิลปะ 3", R: "1.0" },
            "3359": { C: "ง22101", N: "การงานอาชีพ 3", R: "0.5" },
            "3360": { C: "อ22101", N: "ภาษาอังกฤษ 3", R: "1.5" },
            "3363": { C: "อ20203", N: "ภาษาอังกฤษฟัง-พูด 3", R: "1.0" },
            "3364": { C: "ง20203", N: "งานแปรรูปอาหาร", R: "1.0" },
            "3365": { C: "ค20203", N: "คณิตศาสตร์เพิ่มเติม 3", R: "1.0" },
            "3366": { C: "ว20203", N: "พรีออลิมปิกวิทย์ 3", R: "1.0" },
            "3367": { C: "ว20205", N: "พลังงานทดแทน", R: "1.0" },
            "3368": { C: "ก22901", N: "แนะแนว 3", R: "0" },
            "3369": { C: "ก22902", N: "ลูกเสือ-เนตรนารี 3", R: "0" },
            "3370": { C: "ก22903", N: "ชุมนุม 3", R: "0" },
            "3371": { C: "ก22904", N: "กิจกรรมเพื่อสังคม 3", R: "0" }
        };

        function showError(msg) {
            const errDiv = document.getElementById('errorMessage');
            document.getElementById('errorText').innerText = msg;
            errDiv.classList.remove('hidden');
        }

        function hideError() {
            document.getElementById('errorMessage').classList.add('hidden');
        }

        function showForm() {
            document.getElementById('resultContainer').classList.add('hidden');
            document.getElementById('formContainer').classList.remove('hidden');
        }

        function searchGrade() {
            hideError();
            const id = document.getElementById('studentID').value.trim();
            const bdate = document.getElementById('bDate').value.trim();

            if (!id || !bdate) {
                showError("กรุณากรอกข้อมูลให้ครบถ้วน");
                return;
            }

            // Parse embedded XML
            const parser = new DOMParser();
            const xmlDoc = parser.parseFromString(xmlData, "text/xml");
            const students = xmlDoc.getElementsByTagName("Std");

            let foundStudent = null;

            for (let i = 0; i < students.length; i++) {
                const std = students[i];
                const psn = std.getElementsByTagName("Psn")[0];
                const stdId = psn.getElementsByTagName("Co")[0]?.textContent;
                const stdBd = psn.getElementsByTagName("BD")[0]?.textContent;

                if (stdId === id && stdBd === bdate) {
                    foundStudent = std;
                    break;
                }
            }

            if (!foundStudent) {
                showError("ไม่พบข้อมูลดังกล่าว กรุณาตรวจสอบเลขประจำตัวและวันเกิดอีกครั้ง");
                return;
            }

            renderStudentResults(foundStudent);
        }

        function renderStudentResults(studentNode) {
            const psn = studentNode.getElementsByTagName("Psn")[0];
            const name = psn.getElementsByTagName("Na")[0]?.textContent || "";
            const id = psn.getElementsByTagName("Co")[0]?.textContent || "";
            const gradeLevel = psn.getElementsByTagName("CR")[0]?.textContent || "";

            // Summary Grades
            const th = psn.getElementsByTagName("Th")[0]?.textContent || "-";
            const ma = psn.getElementsByTagName("Ma")[0]?.textContent || "-";
            const sc = psn.getElementsByTagName("Sc")[0]?.textContent || "-";
            const so = psn.getElementsByTagName("So")[0]?.textContent || "-";
            const he = psn.getElementsByTagName("He")[0]?.textContent || "-";
            const ar = psn.getElementsByTagName("Ar")[0]?.textContent || "-";
            const jo = psn.getElementsByTagName("Jo")[0]?.textContent || "-";
            const en = psn.getElementsByTagName("En")[0]?.textContent || "-";
            const gp = psn.getElementsByTagName("GP")[0]?.textContent || "-";

            let html = `
                <!-- Header Info -->
                <div class="bg-gradient-to-r from-orange-500 to-amber-500 rounded-xl p-4 text-white shadow-md mb-6">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                        <div>
                            <h3 class="text-xl font-bold">${name}</h3>
                            <p class="text-xs text-orange-100 mt-0.5">เลขประจำตัว: ${id}</p>
                        </div>
                        <span class="inline-block bg-white/20 px-3 py-1 rounded-full text-xs font-medium backdrop-blur-sm self-start sm:self-auto">
                            ${gradeLevel}
                        </span>
                    </div>
                </div>

                <!-- Average Grade Summary -->
                <div class="mb-6 bg-amber-50/60 rounded-xl p-4 border border-amber-200">
                    <h4 class="text-sm font-bold text-amber-900 mb-3 flex items-center gap-1.5">
                        <i class="fa-solid fa-chart-pie text-orange-500"></i> ผลการเรียนเฉลี่ยสะสมแยกตามกลุ่มสาระฯ
                    </h4>
                    <div class="grid grid-cols-3 sm:grid-cols-5 md:grid-cols-9 gap-2 text-center text-xs">
                        <div class="bg-white p-2 rounded-lg shadow-sm border border-amber-100">
                            <span class="block text-gray-500">ไทย</span>
                            <span class="font-bold text-orange-600 text-sm">${th}</span>
                        </div>
                        <div class="bg-white p-2 rounded-lg shadow-sm border border-amber-100">
                            <span class="block text-gray-500">คณิต</span>
                            <span class="font-bold text-orange-600 text-sm">${ma}</span>
                        </div>
                        <div class="bg-white p-2 rounded-lg shadow-sm border border-amber-100">
                            <span class="block text-gray-500">วิทย์</span>
                            <span class="font-bold text-orange-600 text-sm">${sc}</span>
                        </div>
                        <div class="bg-white p-2 rounded-lg shadow-sm border border-amber-100">
                            <span class="block text-gray-500">สังคม</span>
                            <span class="font-bold text-orange-600 text-sm">${so}</span>
                        </div>
                        <div class="bg-white p-2 rounded-lg shadow-sm border border-amber-100">
                            <span class="block text-gray-500">สุขศึกษา</span>
                            <span class="font-bold text-orange-600 text-sm">${he}</span>
                        </div>
                        <div class="bg-white p-2 rounded-lg shadow-sm border border-amber-100">
                            <span class="block text-gray-500">ศิลปะ</span>
                            <span class="font-bold text-orange-600 text-sm">${ar}</span>
                        </div>
                        <div class="bg-white p-2 rounded-lg shadow-sm border border-amber-100">
                            <span class="block text-gray-500">การงานฯ</span>
                            <span class="font-bold text-orange-600 text-sm">${jo}</span>
                        </div>
                        <div class="bg-white p-2 rounded-lg shadow-sm border border-amber-100">
                            <span class="block text-gray-500">ภาษาฯ</span>
                            <span class="font-bold text-orange-600 text-sm">${en}</span>
                        </div>
                        <div class="bg-orange-500 text-white p-2 rounded-lg shadow-sm col-span-3 sm:col-span-2 md:col-span-1">
                            <span class="block text-orange-100">GPA รวม</span>
                            <span class="font-bold text-base">${gp}</span>
                        </div>
                    </div>
                </div>
            `;

            // Transcripts / Terms
            const transcripts = studentNode.getElementsByTagName("Tr");
            for (let i = 0; i < transcripts.length; i++) {
                const tr = transcripts[i];
                const yr = tr.getElementsByTagName("Yr")[0]?.textContent || "";
                const tm = tr.getElementsByTagName("Tm")[0]?.textContent || "";
                const ga = tr.getElementsByTagName("GA")[0]?.textContent || "";

                html += `
                    <div class="mb-6 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-sky-500 text-white px-4 py-2.5 flex justify-between items-center text-sm font-semibold">
                            <span>ปีการศึกษา ${yr} ${tm}</span>
                            <span class="bg-white/20 px-2.5 py-0.5 rounded-full text-xs">เกรดเฉลี่ย: ${ga}</span>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-xs sm:text-sm">
                                <thead class="bg-sky-50 text-sky-800 font-medium">
                                    <tr>
                                        <th class="p-3 w-28">รหัสวิชา</th>
                                        <th class="p-3">ชื่อวิชา</th>
                                        <th class="p-3 text-center w-24">${tm === "" ? "ชั่วโมง" : "หน่วยกิต"}</th>
                                        <th class="p-3 text-center w-20">เกรด</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 text-gray-700">
                `;

                const subjects = tr.getElementsByTagName("S");
                for (let j = 0; j < subjects.length; j++) {
                    const subj = subjects[j];
                    const c = subj.getElementsByTagName("C")[0]?.textContent || "";
                    const g = subj.getElementsByTagName("G")[0]?.textContent || "";

                    const meta = subjectMasterDict[c] || { C: c, N: 'วิชาไม่ระบุ', R: '-' };

                    html += `
                        <tr class="hover:bg-gray-50/80 transition-colors">
                            <td class="p-3 font-mono text-gray-500">${meta.C}</td>
                            <td class="p-3 font-medium text-gray-800">${meta.N}</td>
                            <td class="p-3 text-center text-gray-500">${meta.R}</td>
                            <td class="p-3 text-center font-bold ${g === 'ผ' ? 'text-green-600' : 'text-orange-600'}">${g}</td>
                        </tr>
                    `;
                }

                html += `
                                </tbody>
                            </table>
                        </div>
                    </div>
                `;
            }

            document.getElementById('studentDetailArea').innerHTML = html;
            document.getElementById('formContainer').classList.add('hidden');
            document.getElementById('resultContainer').classList.remove('hidden');
        }
    </script>
</body>
</html>
