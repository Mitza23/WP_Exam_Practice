import { Component, OnInit } from '@angular/core';
import {GenericService} from "../service/generic.service";
import {Question} from "../model/Question";

@Component({
  selector: 'app-see-questions',
  templateUrl: './see-questions.component.html',
  styleUrls: ['./see-questions.component.css']
})
export class SeeQuestionsComponent implements OnInit {

  questions: Question[] = [];

  constructor(private service: GenericService) {
    this.service.fetchAllQuestions()
      .subscribe(result => this.questions = result);
  }

  ngOnInit(): void {
  }

}
