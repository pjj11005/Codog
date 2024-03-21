# 2023년 1학기 캡스톤 설계 프로젝트
코독 - 강아지 친구 매칭 웹사이트 (2023.03 ~ 2023.11) [https://codog.co.kr/]

[블로그 내용 정리 링크](https://pjj11005.github.io/projects/2023-11-30-projects-codog/)
## 프로젝트 소개

> **사용자가 선택한 기준에 따라 이상형 월드컵을 진행하여 원하는 강아지와 매칭 시켜주는 프로젝트입니다.**

## 프로젝트 내용
![전이 학습 결과](/image/poster.png)

## 모델 학습

### 모델 성능 향상

- 데이터 증강: 학습 및 검증 데이터에 회전, 확대/축소, 가로/세로 이동, 가로 반전 등 5-7가지 데이터 증강 기법 적용
- 전이 학습: 13가지 다양한 전이 학습 모델을 사용하여 학습하고, 효율적인 성능을 가진 MobileNetV2 모델을 선택

    ![전이 학습 결과](/image/transferlearning.png)

### 모델 성능 평가

- MobileNetV2 모델 학습 결과 (5 에포크): 모델은 약 92.5%의 val_accuracy와 약 0.3의 val_loss로 수렴

- 전체 모델 정확도: 94.17%

    ![정확도와 손실](/image/accuracy&loss.png)

    ![모델 정확도](/image/modelaccuracy.png)

- 정밀도와 재현율: 대부분의 클래스에 대해 높은 정밀도와 재현율을 보이며, 전반적으로 높은 정확도를 달성. 그러나 비글과 말티즈 클래스의 재현율 값이 비교적 낮음

    ![정밀도와 재현율](/image/precision&recall.png)

- confusion matrix: 히트맵 형식으로 나타낸 결과 같은 클래스 외에는 어둡게 표시

    ![confusionmatrix](/image/confusionmatrix.png)
