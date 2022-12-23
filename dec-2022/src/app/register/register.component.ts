import { Component, OnInit } from '@angular/core';
import { ApiService } from '../service/api.service'; 

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {

  form: any = {
    username: null,
    email: null,
    password: null
  };
  isSuccessful = false;
  isSignUpFailed = false;
  errorMessage = '';
  headClass = false;
  heading = '';

  constructor(private authService: ApiService) { }

  ngOnInit(): void {
    this.heading = 'This is example of Data Binding test';
    this.headClass = true;
  }

  
}
