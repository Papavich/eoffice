import React from 'react'
import CalendarList from './calendar/calendar-list'
import Calendar from './calendar/calendar'
import {URL} from '../config'
import RequestList from './request/request-list'
import RequestAdd from './request/request-add'
import RequestAll from './request/request-all'
import CalendarInit from './calendar/calendar-init'
import EvaluationList from './evaluation/evaluation-list'
import EvaluationAdd from './evaluation/evaluation-add'
import EvaluationSubmit from './evaluation/evaluation-submit'
import EvaluationAll from './evaluation/evaluation-all'
import DefenseAll from './defense/defense-all'
import TodoAll from './todo/todo-all'
import AdvisorLoad from './advisor/advisor-load'
import RequestBypass from './request/request-bypass'

export default class Router extends React.Component {

    render() {
        let current = window.location.pathname
        console.log(current)
        let _temp = current.split('/')
        Object.keys(params).map(param => {
            _temp.pop()
        })
        current = ''
        _temp.map(temp => {
            current += (temp + '/')
        })
        current = current.slice(0, -1)
        switch (current) {
            case URL.CALENDAR.CALENDAR_LIST.PATH :
                return <CalendarList/>
                break
            case URL.CALENDAR.CALENDAR_INIT.PATH:
                return <CalendarInit/>
                break
            case URL.CALENDAR.CALENDAR.PATH:
                return <Calendar calendarId={params.calendar_id}/>
                break
            case URL.TODO.TODO_ALL.PATH:
                return <TodoAll/>
                break
            case URL.ADVISOR.ADVISOR_LOAD.PATH:
                return <AdvisorLoad/>
                break
            case URL.REQUEST.REQUEST_BYPASS.PATH:
                return <RequestBypass/>
                break
            case URL.REQUEST.REQUEST_DATA.PATH:
                return <RequestAll/>
                break
            case URL.DEFENSE.DEFENES_ALL.PATH:
                return <DefenseAll/>
                break
            case URL.EVALUATION.EVALUATION_LIST.PATH:
                return <EvaluationList/>
                break
            case URL.EVALUATION.EVALUATION_ADD.PATH:
                return <EvaluationAdd/>
                break
            case URL.EVALUATION.EVALUATION_SUBMIT.PATH:
                return <EvaluationSubmit/>
                break
            case URL.EVALUATION.EVALUATION_ALL.PATH:
                return <EvaluationAll/>
                break
            case URL.REQUEST.REQUEST_LIST.PATH:
                return <RequestList/>
                break
            case URL.REQUEST.REQUEST_ADD.PATH:
                return <RequestAdd calendarId={params.calendar_id} levelId={params.level_id}
                                   semesterId={params.semester_id} actionId={params.action_id}
                                   ownerId={params.owner_id}/>
                break
            case URL.EGS_BASE:
                return <div>HOME</div>
                break
        }
        return (
            <div>ERROR 404 PAGE NOT FOUND</div>
        )
    }
}