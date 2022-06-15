import { Component, OnInit } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {catchError, Observable, of} from "rxjs";
import CONSTANTS from "../../constants";
import {Router} from "@angular/router";

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  id : number = -1;

  constructor(private http: HttpClient,
              private router : Router) { }

  ngOnInit(): void {
  }

  getProfile(username : string, password : string) : Observable<number> {
    // @ts-ignore
    return this.http.get<number>(CONSTANTS.baseUrl+`/UserController.php?action=verify&username=${username}&password=${password}`)
      .pipe(
        catchError(this.handleError('filterProfiles'))
      );
  }

  checkProfile(username : any, password : any) {
    username = username.value;
    password = password.value;
    if (username != "" && password != "") {
      this.getProfile(username, password).subscribe(
        _id => {
          console.log("Id is: " + _id);
          this.id = _id;
          if (this.id == -1) {
            alert("Invalid credentials")
          }
          else {
            sessionStorage.setItem('userid', this.id + '');
            this.router.navigate(['files'])
          }
        },
        error => {
          alert("Error");
        }
      );
    }
    else {
      alert("Username and password must not be empty");
    }
  }

  /**
   * Handle Http operation that failed.
   * Let the app continue.
   * @param operation - name of the operation that failed
   * @param result - optional value to return as the observable result
   */
  private handleError<T>(operation = 'operation', result?: T) {
    return (error: any): Observable<T> => {

      // TODO: send the error to remote logging infrastructure
      console.error(error); // log to console instead

      // Let the app keep running by returning an empty result.
      return of(result as T);
    };
  }

  addProfile(username: any, password: any) {
    username = username.value;
    password = password.value;
    this.http.get<number>(CONSTANTS.baseUrl+`/UserController.php?action=add&username=${username}&password=${password}`)
      .subscribe(
        _id => {
          this.id = _id;
          if (this.id == -1) {
            alert("Invalid credentials")
          }
          else {
            sessionStorage.setItem('userid', this.id + '');
            this.router.navigate(['files'])
          }
        },
        error => {
          alert("Error");
        }
      );
  }
}
