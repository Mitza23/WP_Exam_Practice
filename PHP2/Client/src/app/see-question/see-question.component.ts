import { Component, OnInit } from '@angular/core';
import {GenericService} from "../service/generic.service";
import {Router} from "@angular/router";

@Component({
  selector: 'app-see-question',
  templateUrl: './see-question.component.html',
  styleUrls: ['./see-question.component.css']
})
export class SeeQuestionComponent implements OnInit {

  question: number = 0;
  currentAnswer: string = "";
  totalAnswer: string = "";

  constructor(public service: GenericService, private router: Router) { }

  ngOnInit(): void {
  }

  next(){
      console.log("CURRENT ANSWER: " + this.currentAnswer);
      if (this.currentAnswer.length == 0){
        alert("Answer cannot be empty!");
        return;
      }
      console.log(this.currentAnswer);
      this.totalAnswer += this.currentAnswer + ",";
      console.log("TOTAL ANSWER: " + this.totalAnswer);
      this.question += 1;
      this.currentAnswer = "";

    if (this.question == this.service.questions.length){
      let usernameNullable: string | null = localStorage.getItem("USERNAME_QUIZ132");
      if (usernameNullable == null){
        alert("No user");
        return;
      }
      this.totalAnswer = this.totalAnswer.slice(0, -1);
      console.log("FINAL ANSWER:" + this.totalAnswer);
      this.service.submitAnswers(this.service.quizTitle, this.totalAnswer, usernameNullable)
        .subscribe(result => {
          console.log(result);
          alert("Congrats, your result is: " + result);
          this.router.navigate(["/navigate"]);
        });
    }
  }

}
