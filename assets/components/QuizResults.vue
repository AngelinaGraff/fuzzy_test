<template>
    <div>
      <h1>Результаты теста</h1>
  
      <div v-if="correctQuestions.length || incorrectQuestions.length" class="results">
        <div class="column" v-if="correctQuestions.length > 0">
          <h2>Правильные ответы</h2>
          <ul>
            <li v-for="question in correctQuestions" :key="question.id">
              <strong>{{ question.questionText }}</strong>
              <ul>
                <li v-for="answer in question.answers" :key="answer.id">
                  {{ answer.answerText }}
                </li>
              </ul>
            </li>
          </ul>
        </div>
  
        <div class="column" v-if="incorrectQuestions.length > 0">
          <h2>Неправильные ответы</h2>
          <ul>
            <li v-for="question in incorrectQuestions" :key="question.id">
              <strong>{{ question.questionText }}</strong>
              <ul>
                <li v-for="answer in question.answers" :key="answer.id">
                  {{ answer.answerText }}
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
  
      <button @click="retryQuiz">Пройти тест заново</button>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        correctQuestions: [],
        incorrectQuestions: []
      };
    },
    mounted() {
      const correctAnswerIds = this.$route.query.correctAnswers ? this.$route.query.correctAnswers.split(',').map(Number) : [];
      const incorrectAnswerIds = this.$route.query.incorrectAnswers ? this.$route.query.incorrectAnswers.split(',').map(Number) : [];
  
      fetch(`/api/quiz/results?correct=${correctAnswerIds.join(',')}&incorrect=${incorrectAnswerIds.join(',')}`)
        .then(response => response.json())
        .then(data => {
          this.correctQuestions = data.correctQuestions || [];
          this.incorrectQuestions = data.incorrectQuestions || [];
        })
        .catch(error => {
          console.error('Ошибка при запросе данных:', error);
        });
    },
    methods: {
      retryQuiz() {
        this.$router.push('/quiz');
      }
    }
  };
  </script>
  
  <style scoped>
  .results {
    display: flex;
    justify-content: space-between;
  }
  
  .column {
    width: 45%;
  }
  
  button {
    margin-top: 20px;
  }
  </style>
  