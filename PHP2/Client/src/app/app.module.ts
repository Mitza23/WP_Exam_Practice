import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import {HttpClient, HttpClientModule} from "@angular/common/http";
import {FormsModule} from "@angular/forms";
import { NavigateComponent } from './navigate/navigate.component';
import { SeeQuestionsComponent } from './see-questions/see-questions.component';
import { CreateNewQuizComponent } from './create-new-quiz/create-new-quiz.component';
import { TakeQuizComponent } from './take-quiz/take-quiz.component';
import { SeeQuestionComponent } from './see-question/see-question.component';

@NgModule({
  declarations: [
    AppComponent,
    NavigateComponent,
    SeeQuestionsComponent,
    CreateNewQuizComponent,
    TakeQuizComponent,
    SeeQuestionComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    FormsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
