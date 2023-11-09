<!--/page/tournament.php-->

<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
require "../header.php"; ?>

<head>
    <title>Codog prototype tournament</title>
    <link rel="stylesheet" href="./style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"; integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>


<style>

.first_result_wrapper{
    display : block;;
    width : 100%;
}
.first_result_wrapper img{
    display : block;
    margin : auto;      
}
.image_sel_wrapper{
    background-color : #041948;
}
.image_sel_wrapper > img{
    height : 400px;
    display : block;
    margin : auto;
    object-fit : cover;
}
.out_div{
    width : 100%;
    margin-top : 32px;
    display : flex;
    justify-content : space-between;
    align-items : center;
}
.out_div > div{
    width : calc((100% - 184px) / 3);
    margin-right : 20px;
    box-sizing : border-box;
    border : 2px solid var(--color-point);
    border-radius : 24px;
    padding : 24px;
    background-color : #fff;
}
.out_div p{
    margin-top : 24px;

}
.out_div > div img{ 
    display : block;
    width : calc(100% - 24px);
    margin : auto;
    height  : 200px;
    object-fit : cover
}
.out_div > div:nth=child(3){
    margin-right : 0px;
}
</style>

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

    <div>
        <h2 id="tournament-round">32강 1 / 16</h2>
    </div>

    <div class="inner">
        <div id="tournament">
            <div class="tournament_wrapper">
                <div class="image_sel_wrapper">
                    <img id="select-1" src="dog.png" alt="">
                    <button id="btn-select-1">선택</button>
                </div>
                <div class="between_line"></div>
                <div class="image_sel_wrapper">
                    <img id="select-2" src="dog.png" alt="">
                    <button id="btn-select-2">선택</button>
                </div>
            </div>
    
        </div>
    </div>

    <!--<a href="main.php">작성 완료</a>-->
    <input type="text" style="display: none" id="is_first_chk" value="N">
</body>

<!--<script src="final.js"></script>-->
<!--<script>-->
<!--    initialize();-->
<!--</script>-->

<script>

    const originalArray = [];

    // 랜덤하게 선택된 32개의 요소를 담을 배열
    const randomArray = [];

    let selectedElements = [];

    let winner = [];

    let currentRound = 1;
    let currentIndex = 0;
    let round = 32;

    function initImg() {

        if (round === 2) {
            $('#tournament-round').text(`결승전 1 / 1`);
        } else {
            $('#tournament-round').text(`${round}강 ${currentRound} / ${round / 2}`);
        }


        if (round === 1) {
            $('#tournament-round').text(
                `우승자`
            );
            displayWinner(document.getElementById('tournament'), selectedElements[0]);
            return;
        }

        if ((round === 32 && currentIndex === 32) || (round === 16 && currentIndex === 16) || (round === 8 && currentIndex === 8)
            || (round === 4 && currentIndex === 4) || (round === 2 && currentIndex === 2)) {
            console.log('current', currentIndex)
            selectedElements = winner;
            winner = [];
            currentIndex = 0;
            currentRound = 1;
            round = round / 2;
            initImg();
            return;
        }

        // 선택된 요소를 토너먼트에 추가
        $('#select-1').attr('src', selectedElements[currentIndex]);
        $('#select-2').attr('src', selectedElements[currentIndex + 1]);

    }


    $(document).ready(function () {
        $('#btn-select-1').on('click', () => {
            console.log('click1')
            winner.push(selectedElements[currentIndex]);
            currentIndex += 2;
            currentRound++;
            initImg();
        });
        $('#btn-select-2').on('click', () => {
            console.log('click2')
            winner.push(selectedElements[currentIndex + 1]);
            currentIndex += 2;
            currentRound++;
            initImg();
        });



        $.ajax({
            url: '/api/findDog.php',
            method: 'POST',
            data: {
                size: '<?=$_REQUEST["size"] ?>',
                place: '<?=$_REQUEST["place"] ?>',
                breed: '<?=implode(", ", $_REQUEST["breed"]); ?>'
            },
            dataType: 'JSON'
        }).done(function (response) {
            const breedStr = '<?=implode(", ", $_REQUEST["breed"]); ?>';
            const breeds = breedStr.split(", ");

            //const filteredData = response.result_data.filter((item) => {
            //    return (
            //        item['size'] === '<?php //=$_REQUEST["size"] ?>//' &&
            //        item['place'] === '<?php //=$_REQUEST["place"] ?>//' &&
            //        (item["breed"] === breeds[0] ||
            //            item["breed"] === breeds[1] ||
            //            item["breed"] === breeds[2] ||
            //            item["breed"] === breeds[3])
            //    );
            //});

            if (response.result_data.length === 0) {
                alert("검색 결과가 없습니다.");
            }
            for (const resultData of response.result_data) {
                originalArray.push(`https://codog.co.kr/upload/${resultData.photo}`);
            }

            // Fisher-Yates 알고리즘을 사용하여 랜덤하게 요소 선택
            for (let i = originalArray.length - 1; i >= 0; i--) {
                const randomIndex = Math.floor(Math.random() * (i + 1));
                const randomElement = originalArray[randomIndex];

                // 선택된 요소를 randomArray에 추가하고, 원본 배열에서 제거
                randomArray.push(randomElement);
                originalArray[randomIndex] = originalArray[i];
            }

            // randomArray에서 처음 32개의 요소 추출
            selectedElements = randomArray.slice(0, 32);


            initImg();
        });



    });



    // 최종 우승자를 표시하는 함수
    function displayWinner(tournamentContainer, winner) {
        // var winner = results[0];
        const firstDiv = document.createElement("div");
        const winnerImage1 = document.createElement("img");
        // const winnerImage2 = document.createElement("img");
        // const winnerImage3 = document.createElement("img");
        // const winnerImage4 = document.createElement("img");
        // console.log(winner);
        winnerImage1.src = winner;

        tournamentContainer.innerHTML = "";
        firstDiv.className = 'first_result_wrapper';
        firstDiv.appendChild(winnerImage1);
        tournamentContainer.appendChild(firstDiv);


        $.ajax({
            url: 'https://api.codog.co.kr/run',
            method: 'POST',
            contentType: "application/json",
            data: JSON.stringify({
                size: '<?=$_REQUEST["size"] ?>',
                place: '<?=$_REQUEST["place"] ?>',
                breeds: '<?=implode(",", $_REQUEST["breed"]); ?>',
                winnerImageName: winner
            }),
            dataType: 'json'
        }).done(function (response) {

            console.log(response)
            let i = 0
            if (response.data.length <= 0) {
                alert('데이터가 없습니다.');
                return;
            }
            let out_div = document.createElement("div");
            out_div.classList.add("out_div")
            for (const data of response.data) {

                const divTag = document.createElement("div");
                const winnerImg = document.createElement("img");
                winnerImg.src = `https://codog.co.kr/upload/${response.data[i].photo}`;
                divTag.appendChild(winnerImg)

                const pTag = document.createElement("p");
                pTag.style.textAlign = "center";

                const breedTextNode = document.createTextNode(`품종: ${data.breed}`)

                const nameTextNode = document.createTextNode(`이름: ${data.name}`);
                const kakaoIdTextNode = document.createTextNode(`카톡 아이디: ${data.kakaoId}`);

                let sizeTextNode;
                if (data.size === 'small') {
                    sizeTextNode = document.createTextNode(`사이즈: 소`);
                } else if (data.size === 'medium') {
                    sizeTextNode = document.createTextNode(`사이즈: 중`);
                } else if (data.size === 'big') {
                    sizeTextNode = document.createTextNode(`사이즈: 대`);
                }

                const placeTextNode = document.createTextNode(`사는곳: ${data.place}`);


                let livelyTextNode = document.createTextNode(`lively: ${data.lively}`);
                if (data.lively === 'calm') {
                    livelyTextNode = document.createTextNode(`성격: 조용함`);
                } else if (data.lively === 'medium') {
                    livelyTextNode = document.createTextNode(`성격: 보통`);
                } else if (data.lively === 'outgoing') {
                    livelyTextNode = document.createTextNode(`성격: 활발함`);
                } else if (data.lively === 'more_outgoing') {
                    livelyTextNode = document.createTextNode(`성격: 매우 활발함`);
                }


                let neuteredTextNode;
                if (data.neutered === 'yes') {
                    neuteredTextNode = document.createTextNode(`중성화 유무: 유`);
                } else {
                    neuteredTextNode = document.createTextNode(`중성화 유무: 무`);
                }

                let sexTextNode;
                if (data.sex === 'male') {
                    sexTextNode = document.createTextNode(`성별: 수컷`);
                } else {
                    sexTextNode = document.createTextNode(`성별: 암컷`);
                }

                pTag.appendChild(breedTextNode);
                pTag.appendChild(document.createElement("br"));
                pTag.appendChild(nameTextNode);
                pTag.appendChild(document.createElement("br"));
                pTag.appendChild(kakaoIdTextNode);
                pTag.appendChild(document.createElement("br"));
                pTag.appendChild(sizeTextNode);
                pTag.appendChild(document.createElement("br"));
                pTag.appendChild(placeTextNode);
                pTag.appendChild(document.createElement("br"));
                pTag.appendChild(livelyTextNode);
                pTag.appendChild(document.createElement("br"));
                pTag.appendChild(neuteredTextNode);
                pTag.appendChild(document.createElement("br"));
                pTag.appendChild(sexTextNode);

                divTag.appendChild(pTag);
                out_div.appendChild(divTag)
                
                i++;
            }
            tournamentContainer.appendChild(out_div);
            let gotomainButton = `<button class="form_button" style="margin : auto; margin-top : 120px" onclick="location.href='https://www.codog.co.kr/page/main.php'">메인 화면</button>`;
            document.getElementById("tournament").style.display = "block";
            tournamentContainer.innerHTML = tournamentContainer.innerHTML + gotomainButton;
        });
    }

</script>