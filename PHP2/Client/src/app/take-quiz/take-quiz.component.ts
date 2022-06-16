import { Component, OnInit } from '@angular/core';
import {GenericService} from "../service/generic.service";
import {Router} from "@angular/router";

@Component({
  selector: 'app-take-quiz',
  templateUrl: './take-quiz.component.html',
  styleUrls: ['./take-quiz.component.css']
})
export class TakeQuizComponent implements OnInit {
  quizName: string = "";

  constructor(private service: GenericService, private router: Router) { }

  ngOnInit(): void {
  }

  takeQuiz() {
    this.service.getQuestions(this.quizName)
      .subscribe(result => {
        this.service.questions = result;
        this.service.quizTitle = this.quizName;
        this.router.navigate(['/navigate/currentQuestion']);
      });
  }
}
