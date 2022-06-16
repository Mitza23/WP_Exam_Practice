import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Observable} from "rxjs";
import {Question} from "../model/Question";

@Injectable({
  providedIn: 'root'
})
export class GenericService {

  // DotNet
  // private backendUrl: string = "https://localhost:7111/api";

  // private backendUrl: string = "http://localhost:8080/api";

  // PHP
  private backendUrl: string = "http://localhost/calin/PhpServer/Controller/Controller.php";
  public questions: Question[] = [];
  public quizTitle: string = "";

  constructor(private httpClient: HttpClient) { }

  fetchAllQuestions(): Observable<Question[]>{
    return this.httpClient.post<Question[]>(this.backendUrl, {"action": "displayQuestions"});
  }

  insertQuiz(title: string, questions: string): Observable<any>{
    return this.httpClient.post<any>(this.backendUrl, {"action": "createNewQuiz", "title": title, "questions": questions});
  }

  getQuestions(title: string): Observable<Question[]>{
    return this.httpClient.post<Question[]>(this.backendUrl, {"action": "getQuizQuestions", "title": title});
  }

  submitAnswers(title: string, answers: string, user: string): Observable<number>{
    return this.httpClient.post<number>(this.backendUrl, {"action": "submitAnswers", "username": user, "answers": answers,
        "title": title});
  }
}
