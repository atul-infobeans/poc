import { Component } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = '';

  ngOnInit(): void {
    //this.changeInput();
    this.title = 'This is example of Data Binding';
  }
  
  changeInput(){
    alert("Value Submitted Successfully.");
  }

  changeMethod (event:any){
    console.log(event);
    this.title = event.target.value;
  }
}
