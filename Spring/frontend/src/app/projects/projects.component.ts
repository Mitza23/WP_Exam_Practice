import { Component, OnInit } from '@angular/core';
import {Project} from "./project";
import {HttpClient} from "@angular/common/http";
import CONSTANTS from "../../constants";

@Component({
  selector: 'app-projects',
  templateUrl: './projects.component.html',
  styleUrls: ['./projects.component.css']
})
export class ProjectsComponent implements OnInit {

  list : Project[] = [];

  personal : String[] = [];

  name : string = '';

  constructor(private http: HttpClient) { }

  ngOnInit(): void {
    // @ts-ignore
    this.name = sessionStorage.getItem("name")
  }

  getAll() : void {
    this.http.get<Project[]>(CONSTANTS.backendUrl)
      .subscribe(
        _list => {
          this.list = _list;
        },
        error => {
          alert(error);
        }
      );
  }

  getPersonal() : void {
    this.http.get<String[]>(CONSTANTS.backendUrl+`/personal?name=${this.name}`)
      .subscribe(
        _list => {
          this.personal = _list;
        },
        error => {
          alert(error);
        }
      );
  }

  addProjects(devName : string, projects : string) {
    let projectList : string[] = projects.split(" ")
    this.http.post(CONSTANTS.backendUrl + `/?devName=${devName}&projects=${projectList}`, {})
      .subscribe(
        _ => {},
        error => {
          alert(error);
        }
      )
  }
}
