import { Component, OnInit, Input } from '@angular/core';
import { User } from 'src/app/Model/User';
import { Router, ActivatedRoute } from '@angular/router';

@Component({
  selector: '[app-user]',
  templateUrl: './user.component.html',
  styleUrls: ['./user.component.scss']
})
export class UserComponent implements OnInit {

  @Input("user") user : User;
  constructor(    
    // private route: ActivatedRoute,
    // private router: Router
  ) {
    // this.route.params.subscribe(params => {
    //   console.log(params);
    //   // if (params["term"]) {
    //   //   this.doSearch(params["term"]);
    //   // }
    // });
  }

  ngOnInit() {
  }

  edit($event){
    $event.preventDefault();
     console.log("editar usuario = " + this.user.name)
  }

  delete($event){
    $event.preventDefault();
    console.log("borrar usuario = " + this.user.name)
  }

}
