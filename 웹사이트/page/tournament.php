<?php 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
require $_SERVER["DOCUMENT_ROOT"] . "/header.php"; ?>
<head>
    <title>Codog prototype tournament</title>

    <style>
        .title {
            text-align: center;
            line-height: 1.2;
            font-weight: bold;
            font-size: 1.4rem;
        }

        .main-title{
            padding: 3rem 0 2rem 0;
        }

        #tournament {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            max-width: 1000px;
            margin: 0 auto;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        #tournament > .tournament_wrapper {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
        }

        .image_sel_wrapper {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 48%;
            margin-bottom: 1rem;
            border: 1px solid #eee;
        }

        .image_sel_wrapper button {
            width: 100%;
            padding: 0.6rem 0;
            background-color: #D9D9D9;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }

        .image_sel_wrapper button:hover {
            opacity: 0.5;
        }

        img {
            width: 250px;
            height: 250px;
            padding: 0.5rem;
        }

        .first_result_wrapper {
            flex: 0 0 100%;
            text-align: center;
        }
    </style>
</head>
<body>
<p class="title main-title">

</p>
<div>
    <p id="tournament-round" class="title" style="">32강 1 / 16</p>
</div>
<div id="tournament">
    <div class="tournament_wrapper">
        <div class="image_sel_wrapper">
            <img id="select-1" src="" alt="">
            <button id="btn-select-1">선택</button>
        </div>
        <div class="image_sel_wrapper">
            <img id="select-2" src="" alt="">
            <button id="btn-select-2">선택</button>
        </div>
    </div>

</div>

<!--<a href="main.html">작성 완료</a>-->
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
        if(round === 2) {
            $('#tournament-round').text(
                `결승전 1 / 1`
            );
        }else {
            $('#tournament-round').text(
                `${round}강 ${currentRound} / ${round / 2}`
            );
        }


        if(round === 1) {
            $('#tournament-round').text(
                `우승자`
            );
            displayWinner(document.getElementById('tournament'), selectedElements[0]);
            return;
        }

        if((round === 32 && currentIndex === 32) || (round === 16 && currentIndex === 16) || (round === 8 && currentIndex === 8)
            || (round === 4 && currentIndex === 4) || (round === 2 && currentIndex === 2)){
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
            for (const data of response.data) {
                const divTag = document.createElement("div");
                const winnerImg = document.createElement("img");
                winnerImg.src = `https://codog.co.kr/upload/${response.data[i].photo}`;
                divTag.appendChild(winnerImg)

                const pTag = document.createElement("p");
                pTag.style.textAlign = "center";

                const breedTextNode = document.createTextNode(`품종: ${data.breed}`)

                const nameTextNode = document.createTextNode(`이름: ${data.name}`);

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

                tournamentContainer.appendChild(divTag);
                i++;
            }

        });
    }

</script>