import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import {NavigateComponent} from "./navigate/navigate.component";
import {SeeQuestionsComponent} from "./see-questions/see-questions.component";
import {CreateNewQuizComponent} from "./create-new-quiz/create-new-quiz.component";
import {TakeQuizComponent} from "./take-quiz/take-quiz.component";
import {SeeQuestionComponent} from "./see-question/see-question.component";

const routes: Routes = [
  {path: 'navigate', component: NavigateComponent},
  {path: 'navigate/seeQuestions', component: SeeQuestionsComponent},
  {path: 'navigate/createNewQuiz', component: CreateNewQuizComponent},
  {path: 'navigate/takeQuiz', component: TakeQuizComponent},
  {path: 'navigate/currentQuestion', component: SeeQuestionComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
