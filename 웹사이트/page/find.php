<?php require "../header.php"; ?>

<head>
    <title>Codog prototype find</title>
</head>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/moonspam/NanumSquare@2.0/nanumsquare.css">
<link rel="stylesheet" href="./style.css">

<body>
    <a href="./main.php">
        <header>
            <div class="inner">
                <img src="dog.png" />
                <h3>
                    CODOG
                </h3>
            </div>
            
        </header>
    </a>
    <form id="findForm" action="tournament.php" onsubmit="return validateForm()" method="post">
        <!-- 정보 제출 할 링크주소 걸기 -->
        <h2>선호하는 친구의 사이즈를 골라 주세요!</h2>
        
        <input type="radio" class="hidden" name="size" id="small" value="small" required />
        <input type="radio" class="hidden" name="size" id="medium" value="medium" />
        <input type="radio" class="hidden" name="size" id="big" value="big" />


        <div class="label_list">
            <label id="input_label_for_small" for="small">

                <img src="./img/small-dog-icon-8.jpg" class="label_img" alt="">
                <span>소형견 (~7kg)</span>
            </label>
            <label id="input_label_for_med" for="medium">

                <img src="./img/med-dog-icon-12.jpg" class="label_img" alt="">
                <span>중형견 (7~15kg)</span>
            </label>
            <label id="input_label_for_big" for="big">
                <img src="./img/big-icon-png-2.jpg" class="label_img" alt="">
                <span>대형견 (15~kg)</span>
            </label>
        </div>

        <h2>원하는 친구의 지역구를 선택해 주세요!</h2>
        <select id="place" class="form_select" name="place">
            <option value="강남구" selected="selected" required>강남구</option>
            <option value="강동구">강동구</option>
            <option value="강북구">강북구</option>
            <option value="강서구">강서구</option>
            <option value="관악구">관악구</option>
            <option value="광진구">광진구</option>
            <option value="구로구">구로구</option>
            <option value="금천구">금천구</option>
            <option value="노원구">노원구</option>
            <option value="도봉구">도봉구</option>
            <option value="동대문구">동대문구</option>
            <option value="동작구">동작구</option>
            <option value="마포구">마포구</option>
            <option value="서대문구">서대문구</option>
            <option value="서초구">서초구</option>
            <option value="성동구">성동구</option>
            <option value="성북구">성북구</option>
            <option value="송파구">송파구</option>
            <option value="양천구">양천구</option>
            <option value="영등포구">영등포구</option>
            <option value="용산구">용산구</option>
            <option value="은평구">은평구</option>
            <option value="종로구">종로구</option>
            <option value="중구">중구</option>
            <option value="중랑구">중랑구</option>
        </select>

        <h2>만나고 싶은 품종을 4개 골라주세요!</h2>
        <select class="form_select" id="breed" name="breed[]" style="height: 120px;" multiple="multiple" required>
            <option value="Beagle">비글</option>
            <option value="Bichon">비숑</option>
            <option value="Border colie">보더콜리</option>
            <option value="Bulldog">불독</option>
            <option value="Chihuahua">치와와</option>
            <option value="Dachshund">닥스훈트</option>
            <option value="Jindo dog">진돗개</option>
            <option value="Maltese">말티즈</option>
            <option value="Pomeranian">포메라니안</option>
            <option value="Poodle">푸들</option>
            <option value="Retriever">리트리버</option>
            <option value="Shiba dog">시바견</option>
            <option value="Shih tzu">시츄</option>
            <option value="Welsh corgi">웰시코기</option>
            <option value="Yorkshire terrior">요크셔테리어</option>
            <option value="etc">기타</option>
        </select>

        <button type="submit" class="form_button">제출</button>
    </form>
    <!--<a href="tournament.php" id="completion-link" style="display: none;">작성 완료</a>-->

    <script>
        function validateForm() {
            // 여기에 확인 작업을 수행하는 코드를 작성합니다.
            // 필요한 확인 작업을 수행한 후, 폼을 제출해야 하는지 여부를 반환합니다.
            const breeds = $('#breed').val();
            console.log(breeds);
            if (breeds.length < 4) {
                alert('품종은 4개를 선택해야 합니다.');
                return false;
            }

            // 확인 작업을 모두 통과한 경우, 폼 제출을 진행
            return true;
        }

        var selectElement = document.querySelector('select[name="breed[]"]');
        var maxSelections = 4; // 최대 선택 가능한 옵션 수

        selectElement.addEventListener('mousedown', function (event) {
            var option = event.target;

            // 이미 선택된 옵션인 경우 선택을 해제합니다.
            if (option.selected) {
                option.selected = false;
            }
            // 선택되지 않은 옵션인 경우,
            // 선택된 옵션의 수가 최대 선택 가능한 옵션 수를 초과하지 않는 경우에만 선택합니다.
            else if (selectElement.selectedOptions.length < maxSelections) {
                option.selected = true;
            }

            // 이벤트의 전파를 중단하여 기본 동작이 실행되지 않도록 합니다.
            event.preventDefault();
        });

    </script>
</body>