import { Component, OnInit, Output, EventEmitter } from '@angular/core';
import { FormControl } from '@angular/forms';
import { debounceTime, distinctUntilChanged } from 'rxjs/operators';

@Component({
  selector: 'app-search-user',
  templateUrl: './search-user.component.html',
  styleUrls: ['./search-user.component.scss']
})
export class SearchUserComponent implements OnInit {

  @Output() searchUser = new EventEmitter<string>();
  public searchTerm : FormControl ;

  constructor() { }

  ngOnInit() {
    this.searchTerm = new FormControl();
    this.searchTerm.valueChanges.pipe(
      debounceTime(400),
      distinctUntilChanged(),
      //switchMap(term => this.userService.searchUser(term)),
    ).subscribe(($val)=>{  
      this.searchUser.emit($val);
    });
  }
}
