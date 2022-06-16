import { Component, OnInit } from '@angular/core';
import {Document} from "./document";
import {HttpClient} from "@angular/common/http";
import {Keyword} from "./keyword";

@Component({
  selector: 'app-documents',
  templateUrl: './documents.component.html',
  styleUrls: ['./documents.component.css']
})
export class DocumentsComponent implements OnInit {

  list : Document[] = [];

  selected? : Document;

  backendUrl : string = "http://localhost:8080/api";

  document : string = '';

  constructor(private http: HttpClient) { }

  ngOnInit(): void {
  }

  onSelect(entity: Document) {
    this.selected = entity;
    // @ts-ignore
    var params = new URLSearchParams(this.selected);
    this.http.post(this.backendUrl + `/document`, this.selected, {responseType: 'text'})
      .subscribe(
        doc => {
          this.document = doc;
        }
      )
  }

  getDocuments(searchTitle: string) {
    this.http.get<Document[]>(this.backendUrl + `?title=${searchTitle}`)
      .subscribe(
        list => {
          this.list = list;
        }
      )
  }

  addKeyword(key: string, value: string) {
    const entity = new Keyword(key, value)
    this.http.post(this.backendUrl, {entity})
  }
}
