import { createRouter, createWebHistory } from 'vue-router';
import Quiz from './components/Quiz.vue';
import QuizResults from './components/QuizResults.vue';

const routes = [
    { path: '/quiz', component: Quiz },
    { path: '/results', component: QuizResults }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
