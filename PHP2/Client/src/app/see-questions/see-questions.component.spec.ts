import { ComponentFixture, TestBed } from '@angular/core/testing';

import { SeeQuestionsComponent } from './see-questions.component';

describe('SeeQuestionsComponent', () => {
  let component: SeeQuestionsComponent;
  let fixture: ComponentFixture<SeeQuestionsComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ SeeQuestionsComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(SeeQuestionsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
