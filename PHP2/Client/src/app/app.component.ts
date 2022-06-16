import { Component } from '@angular/core';
import {Router} from "@angular/router";

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'Client';
  username: string = "";

  constructor(public router: Router) {

  }

  submit() {
    if (this.username.length <= 3){
      alert("Username too short!");
      return;
    }
    localStorage.setItem("USERNAME_QUIZ132", this.username);
    this.router.navigate(['/navigate']);
  }
}
