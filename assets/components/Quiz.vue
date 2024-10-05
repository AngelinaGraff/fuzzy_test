<template>
  <div>
    <h1>Пройдите тест</h1>
    <form @submit.prevent="submitAnswers">
      <div v-for="(question, index) in questions" :key="`question-${index}`" class="question-block">
        <h3>{{ question.questionText }}</h3>
        <div v-for="(answer, idx) in question.answers" :key="`answer-${idx}`">
          <label>
            <input type="checkbox" 
              v-model="userAnswers[question.id]" 
              :value="answer.id" 
            />
            {{ answer.answerText }}
          </label>
        </div>
      </div>
      <button type="submit">Отправить ответы</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      questions: [],
      userAnswers: {}
    };
  },
  mounted() {
    this.fetchQuestions();
  },
  methods: {
    fetchQuestions() {
      fetch('/api/quiz')
        .then(response => response.json())
        .then(data => {
          this.questions = data;
          data.forEach(question => {
            this.userAnswers[question.id] = [];
          });
        });
    },
    submitAnswers() {
      fetch('/api/quiz/submit', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ answers: this.userAnswers }),
      })
      .then(response => response.json())
      .then(data => {
        this.$router.push({
          path: '/results',
          query: {
            correctAnswers: data.correctAnswers.join(','),
            incorrectAnswers: data.incorrectAnswers.join(',')
          }
        });
      });
    }
  }
};
</script>

<style scoped>
.question-block {
  margin-bottom: 20px;
}
</style>
