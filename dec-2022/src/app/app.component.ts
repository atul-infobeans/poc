import { Component } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = '';
  headClass = false;
  buttonStyle = {};
  isShow = false;
  message = '';
  items = [    'Sandy',
    'Jeff',
    'Dana',
    'Devid',
    'Ban',
  ];

  ngOnInit(): void {
    //this.changeInput();
    this.title = 'This is example of Data Binding';
    this.headClass = true;
    
  }
  
  changeInput(name: any){
    this.message = "Value Submitted Successfully.";
    this.isShow = true;
    this.buttonStyle = {
      'background-color': 'gray',
      'color': 'brown',
    }
  console.log(name);
    this.items.push(name);
  }

  changeMethod (event:any){
    console.log(event);
    this.title = event.target.value;
    this.headClass = false;
  }
}
