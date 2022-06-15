import { Component, OnInit } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Router} from "@angular/router";
import {File} from "../../types";
import CONSTANTS from "../../constants";
import {catchError, Observable, of} from "rxjs";

@Component({
  selector: 'app-files',
  templateUrl: './files.component.html',
  styleUrls: ['./files.component.css']
})
export class FilesComponent implements OnInit {

  list : File[] = [];

  page : number = 0;

  freq : { [filename: string] : number; } = {};

  visited : number = 0;

  filename : string = '';

  frequency : number = 0;

  constructor(private http: HttpClient,
              private router : Router) { }

  ngOnInit(): void {
    this.page = 0;
    this.visited = -1;
    this.getPage();
  }

  getPage() {
    this.http.get<File[]>(CONSTANTS.baseUrl+'/FileController.php?action=getPage&step='+this.page+'&userid='+sessionStorage.getItem("userid"))
      .pipe(
        catchError(this.handleError<File[]>('getPage', []))
      ).subscribe(
      _list => {
        // @ts-ignore
        this.list = _list;
        console.log(_list);
      },
      error => {
        alert(error)
      }
    );
    if(this.page > this.visited) {
      this.visited = this.page;
      for(let $entry of this.list) {
        if($entry.filename in this.freq) {
          this.freq[$entry.filename] += 1;
        }
        else {
          this.freq[$entry.filename] = 1;
        }
      }
    }
    for(let key in this.freq) {
      if(this.frequency < this.freq[key]){
        this.frequency = this.freq[key];
        this.filename = key;
      }
    }
    console.log(this.freq);
  }

  nextPage() {
    this.page += 1;
    this.getPage();
  }

  previousPage(){
    this.page -= 1;
    this.getPage();
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

  addFile(name: HTMLInputElement, path: HTMLInputElement, size: HTMLInputElement) {
    this.http.get(CONSTANTS.baseUrl+'/FileController.php?action=add&name='+name.value+'&path='+path.value+'&size='+
      size.value+'&userid='+sessionStorage.getItem("userid"))
      .pipe(
        catchError(this.handleError<File[]>('add', []))
      )
  }
}
