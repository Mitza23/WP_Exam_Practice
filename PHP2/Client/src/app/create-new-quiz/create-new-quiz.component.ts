import { Component, OnInit } from '@angular/core';
import {GenericService} from "../service/generic.service";
import {FormBuilder} from "@angular/forms";
import {Router} from "@angular/router";

@Component({
  selector: 'app-create-new-quiz',
  templateUrl: './create-new-quiz.component.html',
  styleUrls: ['./create-new-quiz.component.css']
})
export class CreateNewQuizComponent implements OnInit {

  questions: number = -1;
  sent: boolean = false;
  array: Array<string> = [];
  name: string = "";
  constructor(private service: GenericService, private router: Router) { }

  ngOnInit(): void {
  }

  submit() {
    if (this.questions <= 0){
      alert("Invalid number of questions!");
      return;
    }
    this.sent = true;
    this.array = new Array<string>(this.questions);
  }

  addQuestions(){
    let finalString: string = "";
    for (let item of this.array) {
      finalString += item + ",";
    }
    finalString = finalString.slice(0, -1);
    this.service.insertQuiz(this.name, finalString)
      .subscribe(result => {
        console.log(result);
        alert("Successfully added quiz!");
        this.router.navigate(["/navigate"]);
      });
  }


  trackByIdx(index: number, object: any){
    return index;
  }
}
