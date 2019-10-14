import moment from 'moment';
import { config } from 'Config';

export default {
    methods: {
        formattedAgoDate (date) {
            return moment.utc(date).tz(config.timezone).fromNow();
        }
    }
}
